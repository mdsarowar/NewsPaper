@extends('admin.master')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit Category</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Update category details or change its parent</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center">
                        <i data-lucide="list" class="w-4 h-4 mr-2"></i>
                        Categories
                    </a>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400 mr-3 mt-0.5"></i>
                <div class="flex-1">
                    <h4 class="text-sm font-medium text-green-800 dark:text-green-300">Success!</h4>
                    <p class="text-sm text-green-700 dark:text-green-400 mt-1">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <div class="flex items-start">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600 dark:text-red-400 mr-3 mt-0.5"></i>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-red-800 dark:text-red-300 mb-2">Please fix the following errors:</h4>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="text-sm text-red-700 dark:text-red-400">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Edit Form -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm">
            <form id="categoryForm" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Edit Category Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category Name *</label>
                            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                                   class="form-input w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                        </div>

                        <!-- Parent -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Parent Category</label>
                            <select name="parent_id"
                                    class="form-input w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                                <option value="">None</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Order -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order</label>
                            <input type="number" name="display_order" value="{{ old('display_order', $category->display_order) }}"
                                   class="form-input w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                            <select name="status"
                                    class="form-input w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                                <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 border-t pt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category Image</label>
                            @if($category->image)

                                <h1>{{'storage/'.$category->image}}</h1>

                                <img src="{{ asset('storage/'.$category->image) }}" alt="" class="w-full h-48 object-cover rounded-lg mb-4">

                            @endif
                            <div class="drag-area w-full p-4 border-2 border-dashed @error('image') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg text-center hover:border-indigo-400 cursor-pointer">
                                <input type="file" id="categoryImage" name="image" accept="image/*" class="hidden">
                                <i data-lucide="upload-cloud" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Click to upload or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">PNG, JPG up to 2MB</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                            <textarea name="description" rows="8"
                                      class="form-input w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">{{ old('description', $category->description) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t flex justify-between border-gray-200 dark:border-gray-700">
                        <a href="{{ route('categories.index') }}" class="px-6 py-3 text-gray-700 bg-white border rounded-lg hover:bg-gray-50 flex items-center">
                            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center">
                            Update Category
                            <i data-lucide="save" class="w-4 h-4 ml-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
@endsection
