<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Sarowar\LaravelFileUpload\FileUpload;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::with(['parent', 'children'])
            ->withCount('articles');

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Type Filter (Parent/Child)
        if ($request->filled('type')) {
            if ($request->type == 'parent') {
                $query->whereNull('parent_id');
            } elseif ($request->type == 'child') {
                $query->whereNotNull('parent_id');
            }
        }

        // Sorting
        $sortField = $request->get('sort', 'display_order');
        $query->orderBy($sortField, 'asc');

        // Pagination
        $categories = $query->paginate(15)->withQueryString();

        // Stats
        $totalCategories = Category::count();
        $activeCategories = Category::where('status', 'active')->count();
        $inactiveCategories = Category::where('status', 'inactive')->count();
        $parentCategories = Category::whereNull('parent_id')->count();

        return view('admin.category.index', compact(
            'categories',
            'totalCategories',
            'activeCategories',
            'inactiveCategories',
            'parentCategories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
            'display_order' => 'nullable|integer|min:0',
        ]);

        try {
            // File upload
            if ($request->hasFile('image')) {
                $fileupload=new FileUpload();
                $validated['image'] =$fileupload->fileUpload($request->file('image'), 'category/');
            }

            // Category create
            $category = Category::create($validated);

            return redirect()->route('categories.index')
                ->with('success', 'Category created successfully!');

        } catch (\Exception $e) {

//            if (isset($validated['image']) && file_exists(public_path('category/' . $validated['image']))) {
//                unlink(public_path('category/' . $validated['image']));
//            }

            return redirect()->back()
                ->with('error', 'Failed to create category: ' . $e->getMessage())
                ->withInput();
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
        return view('admin.category.edit',[
            'categories'=> Category::all(),
            'category'=>Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category=Category::find($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
            'display_order' => 'nullable|integer|min:0',
        ]);

        try {
            if ($request->hasFile('image')) {
                $fileupload=new FileUpload();
                $validated['image'] =$fileupload->fileUpload($request->file('image'), 'category/');
            }

            $category->update($validated);

            return redirect()->route('categories.index')
                ->with('success', 'Category updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update category!')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id);
        try {
            // Check if has children
//            if ($category->children()->count() > 0) {
//                return redirect()->back()
//                    ->with('error', 'Cannot delete category with sub-categories!');
//            }
//
//            // Check if has articles
//            if ($category->articles()->count() > 0) {
//                return redirect()->back()
//                    ->with('error', 'Cannot delete category with articles!');
//            }

            // Delete image
            if ($category->image && file_exists(storage_path( $category->image))) {
//                return storage_path($category->image);
                unlink(storage_path( $category->image));
            }
//return 'nai';
            $category->delete();

            return redirect()->route('categories.index')
                ->with('success', 'Category deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete category!');
        }
    }
}
