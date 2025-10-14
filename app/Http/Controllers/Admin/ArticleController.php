<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tags;
use Illuminate\Http\Request;
use Sarowar\LaravelFileUpload\FileUpload;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Calculate stats
        $totalArticles = Article::count();
        $publishedArticles = Article::where('status', 'published')->count();
        $draftArticles = Article::where('status', 'draft')->count();
        $featuredArticles = Article::where('is_featured', 1)->count();

        // Start building the query
        $query = Article::with(['category', 'user', 'tags']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Type filter (featured or breaking)
        if ($request->filled('type')) {
            if ($request->type === 'featured') {
                $query->where('is_featured', 1);
            } elseif ($request->type === 'breaking') {
                $query->where('is_breaking', 1);
            }
        }

        // Sort by
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = 'desc';

        switch ($sortBy) {
            case 'title':
                $sortOrder = 'asc';
                break;
            case 'published_at':
            case 'views':
            case 'created_at':
            default:
                $sortOrder = 'desc';
                break;
        }

        $query->orderBy($sortBy, $sortOrder);

        // Paginate results
        $articles = $query->paginate(15)->withQueryString();

        // Get all categories for filter dropdown
        $categories = Category::where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.article.index', compact(
            'articles',
            'categories',
            'totalArticles',
            'publishedArticles',
            'draftArticles',
            'featuredArticles'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.article.create',[
            'articles' => Article::all(),
            'categories' => Category::all(),
            'tags' => Tags::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'breaking_title' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,avif,png|max:2048',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,avif,png|max:2048',
            'tags' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_breaking' => 'nullable|boolean',
            'allow_comments' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        try {
            // Handle main image upload
            if ($request->hasFile('image')) {
                $fileupload = new FileUpload();
                $validated['image'] = $fileupload->fileUpload($request->file('image'), 'article/images/');
            }

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                $fileupload = new FileUpload();
                $validated['featured_image'] = $fileupload->fileUpload($request->file('featured_image'), 'article/featured_image/');
            }

            // Convert checkboxes to boolean
            $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
            $validated['is_breaking'] = $request->has('is_breaking') ? 1 : 0;
            $validated['allow_comments'] = $request->has('allow_comments') ? 1 : 0;

            // Set breaking_title to null if not breaking news
            if (!$validated['is_breaking']) {
                $validated['breaking_title'] = null;
            }

            // Calculate reading time (approximate: 200 words per minute)
            $wordCount = str_word_count(strip_tags($validated['content']));
            $validated['reading_time'] = max(1, ceil($wordCount / 200));

            // Set user_id from authenticated user
            $validated['user_id'] = auth()->id();

            // Set published_at to now if status is published and no date provided
            if ($validated['status'] === 'published' && empty($validated['published_at'])) {
                $validated['published_at'] = now();
            }

            // Create the article
            $article = Article::create($validated);

            // Handle tags
            if ($request->filled('tags')) {
                // Tagify returns JSON array, decode it
                $tagsData = json_decode($request->tags, true);

                if (is_array($tagsData)) {
                    $tagIds = [];

                    foreach ($tagsData as $tagItem) {
                        // Handle both array and string formats
                        $tagName = is_array($tagItem) ? ($tagItem['value'] ?? $tagItem) : $tagItem;

                        // Find or create tag
                        $tag = Tags::firstOrCreate(
                            ['name' => $tagName]
                        );

                        $tagIds[] = $tag->id;
                    }

                    // Sync tags with the article
                    $article->tags()->sync($tagIds);
                } else {
                    // Handle comma-separated string fallback
                    $tagArray = explode(',', $request->tags);
                    $tagIds = [];

                    foreach ($tagArray as $tagName) {
                        $tagName = trim($tagName);
                        if (!empty($tagName)) {
                            $tag = Tags::firstOrCreate(
                                ['name' => $tagName]
                            );
                            $tagIds[] = $tag->id;
                        }
                    }

                    $article->tags()->sync($tagIds);
                }
            }

            // Redirect with success message
            return redirect()
                ->route('articles.index')
                ->with('success', 'Article created successfully!');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Article creation failed: ' . $e->getMessage());

            // Redirect back with error
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create article: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.article.edit',[
            'article' => Article::find($id),
            'categories' => Category::all(),
            'tags' => Tags::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $article = Article::findOrFail($id);

        // Validation Rules
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'breaking_title' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'tags' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_breaking' => 'nullable|boolean',
            'allow_comments' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        try {
            // Handle main image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($article->image && file_exists(storage_path($article->image))) {
                    unlink(storage_path($article->image));
                }

                $fileupload = new FileUpload();
                $validated['image'] = $fileupload->fileUpload($request->file('image'), 'article/images/');
            }

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                // Delete old featured image
                if ($article->featured_image && file_exists(storage_path($article->featured_image))) {
                    unlink(storage_path($article->featured_image));
                }

                $fileupload = new FileUpload();
                $validated['featured_image'] = $fileupload->fileUpload($request->file('featured_image'), 'article/featured_image/');
            }

            // Convert checkboxes to boolean
            $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
            $validated['is_breaking'] = $request->has('is_breaking') ? 1 : 0;
            $validated['allow_comments'] = $request->has('allow_comments') ? 1 : 0;

            // Set breaking_title to null if not breaking news
            if (!$validated['is_breaking']) {
                $validated['breaking_title'] = null;
            }

            // Calculate reading time (approximate: 200 words per minute)
            $wordCount = str_word_count(strip_tags($validated['content']));
            $validated['reading_time'] = max(1, ceil($wordCount / 200));

            // Set user_id from authenticated user
            $validated['user_id'] = auth()->id();

            // Set published_at to now if status is published and no date provided
            if ($validated['status'] === 'published' && empty($validated['published_at'])) {
                $validated['published_at'] = now();
            }

            // Update article
            $article->update($validated); // ✅ ঠিক করেছি: $article = remove করেছি

            // Handle tags
            if ($request->filled('tags')) {
                // Tagify returns JSON array, decode it
                $tagsData = json_decode($request->tags, true);

                if (is_array($tagsData)) {
                    $tagIds = [];

                    foreach ($tagsData as $tagItem) {
                        $tagName = is_array($tagItem) ? ($tagItem['value'] ?? $tagItem) : $tagItem;

                        // Find or create tag
                        $tag = Tags::firstOrCreate(
                            ['name' => $tagName]
                        );

                        $tagIds[] = $tag->id;
                    }

                    // Sync tags with the article
                    $article->tags()->sync($tagIds);
                } else {
                    // Handle comma-separated string
                    $tagArray = explode(',', $request->tags);
                    $tagIds = [];

                    foreach ($tagArray as $tagName) {
                        $tagName = trim($tagName);
                        if (!empty($tagName)) {
                            $tag = Tags::firstOrCreate(
                                ['name' => $tagName]
                            );
                            $tagIds[] = $tag->id;
                        }
                    }

                    $article->tags()->sync($tagIds);
                }
            } else {
                // Remove all tags if tags field is empty
                $article->tags()->detach();
            }

            // Return success response
            return redirect()
                ->route('articles.index')
                ->with('success', 'Article updated successfully!');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Article update failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update article: ' . $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $article = Article::findOrFail($id);

            // Delete images from storage
            if ($article->image && file_exists(storage_path($article->image))) {
                unlink(storage_path($article->image));
            }
//            if ($article->image && Storage::disk('public')->exists($article->image)) {
//                Storage::disk('public')->delete($article->image);
//            }

//            if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
//                Storage::disk('public')->delete($article->featured_image);
//            }
            if ($article->featured_image && file_exists(storage_path($article->featured_image))) {
                unlink(storage_path($article->featured_image));
            }

            // Detach all tags
            $article->tags()->detach();

            // Delete the article
            $article->delete();

            return redirect()
                ->route('articles.index')
                ->with('success', 'Article deleted successfully!');

        } catch (\Exception $e) {
            \Log::error('Article deletion failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Failed to delete article. Please try again.');
        }
    }
}
