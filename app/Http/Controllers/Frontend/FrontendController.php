<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendController extends Controller
{
    /**
     * Display homepage
     */
    public function index()
    {
        // Breaking News
        $breakingNews = Article::where('status', 'published')
            ->where('is_breaking', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        // Featured Articles
        $featuredArticles = Article::where('status', 'published')
            ->where('is_featured', true)
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->take(3)
            ->get();

        // Latest Articles
        $latestArticles = Article::where('status', 'published')
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->take(9)
            ->get();

        // Category wise articles (Top 3 categories)
        $categories = Category::where('status', 'active')
            ->withCount(['articles' => function($query) {
                $query->where('status', 'published');
            }])
            ->orderBy('articles_count', 'desc')
            ->take(3)
            ->get();

        $categoryArticles = [];
        foreach ($categories as $category) {
            $categoryArticles[$category->name] = Article::where('status', 'published')
                ->where('category_id', $category->id)
                ->with('category')
                ->latest('published_at')
                ->take(4)
                ->get();
        }

        return view('frontend.pages.home', compact(
            'breakingNews',
            'featuredArticles',
            'latestArticles',
            'categoryArticles'
        ));
    }

    /**
     * Display single article
     */
    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'tags', 'user'])
            ->withCount(['comments as total_comments' => function($query) {
                $query->where('status', 'approved');
            }])
            ->firstOrFail();

        // Increment view count
        $article->increment('view_count');

        // Get approved comments with nested replies
        $comments = $article->comments()
//            ->where('status', 'approved')
            ->whereNull('parent_id')
            ->with(['user',
                'replies.user',
                'replies.parent',
                'replies.parent.user',   // parent এর user
                'replies.replies.user',
                'replies.replies.parent',
                'replies.replies.parent.user']) // 3 levels
            ->latest()
            ->get();

        // Related articles
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->take(4)
            ->get();

        return view('frontend.pages.show', compact('article', 'comments', 'relatedArticles'));
    }

    public function all_comments_count($slug){
        return Article::find($slug)->comments()->count();

    }

    /**
     * Display category articles
     */
    public function showCategory($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $articles = Article::where('status', 'published')
            ->where('category_id', $category->id)
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->paginate(12);

        return view('frontend.pages.category', compact('category', 'articles'));
    }

    /**
     * Display tag articles
     */
    public function showTag($slug)
    {
        $tag = \App\Models\Tags::where('slug', $slug)->firstOrFail();
//        return $tag;
//        $articles=$tag->articles()
        $articles = $tag->articles()
            ->where('status', 'published')
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->paginate(12);
//        return $tag;

        return view('frontend.pages.tag', compact('tag', 'articles'));
    }

    /**
     * Display all articles
     */
    public function allArticles(Request $request)
    {
        $query = Article::where('status', 'published')
            ->with(['category', 'tags']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sort
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'oldest':
                $query->oldest('published_at');
                break;
            default:
                $query->latest('published_at');
        }

        $articles = $query->paginate(12);
        $categories = Category::where('status', 'active')->get();

        return view('frontend.pages.all_article', compact('articles', 'categories'));
    }

    /**
     * Search articles
     */
    public function search(Request $request)
    {
        $search = $request->get('q');
        $categories=Category::all();

        $articles = Article::where('status', 'published')
            ->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            })
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->paginate(12);

        return view('frontend.pages.search', compact('articles','categories', 'search'));
    }

    public  function getDataByApi()
    {
        $api='https://newsdata.io/api/1/sources?country=BD&apikey=pub_6e1d818152574b928e9f066fc3be0ee1';

        $data=Http::async()->get($api);
        $response = $data->wait();
        $jsondata=$response->json();

        return $jsondata;


    }

}
