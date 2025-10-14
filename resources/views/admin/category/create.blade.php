@extends('admin.master')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Add New Category</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Create a new category for organizing news articles</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{route('categories.index')}}" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center">
                        <i data-lucide="x" class="w-4 h-4 mr-2"></i>
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

        @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 flex items-start">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 dark:text-red-400 mr-3 mt-0.5"></i>
                <div class="flex-1">
                    <h4 class="text-sm font-medium text-red-800 dark:text-red-300">Error!</h4>
                    <p class="text-sm text-red-700 dark:text-red-400 mt-1">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
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
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Category Creation Form -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm">
            <form id="categoryForm" action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Category Information</h3>

                    <!-- Basic Fields Grid - 2 columns -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Category Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category Name *</label>
                            <div class="relative">
                                <i data-lucide="folder" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    required
                                    value="{{ old('name') }}"
                                    class="form-input w-full pl-12 pr-4 py-3 border @error('name') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    placeholder="Enter category name"
                                >
                            </div>
                            @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Parent Category -->
                        <div>
                            <label for="parent_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Parent Category</label>
                            <div class="relative">
                                <i data-lucide="folder-tree" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                <select
                                    id="parent_id"
                                    name="parent_id"
                                    class="form-input w-full pl-12 pr-4 py-3 border @error('parent_id') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                >
                                    <option value="">None </option>
                                     @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('parent_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Display Order -->
                        <div>
                            <label for="display_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order</label>
                            <div class="relative">
                                <i data-lucide="sort-asc" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                <input
                                    type="number"
                                    id="display_order"
                                    name="display_order"
                                    value="{{ old('display_order', 0) }}"
                                    min="0"
                                    class="form-input w-full pl-12 pr-4 py-3 border @error('display_order') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    placeholder="0"
                                >
                            </div>
                            @error('display_order')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                            <div class="relative">
                                <i data-lucide="activity" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                <select
                                    id="status"
                                    name="status"
                                    required
                                    class="form-input w-full pl-12 pr-4 py-3 border @error('status') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                >
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            @error('status')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Image and Description Section - 2 columns -->
                    <div class="mt-8 border-t dark:border-gray-700 pt-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Category Image Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category Image</label>
                                <div class="flex flex-col">
                                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center mb-4 overflow-hidden" id="imagePreview">
                                        <i data-lucide="image" class="w-12 h-12 text-gray-400" id="defaultIcon"></i>
                                        <img id="previewImg" class="w-full h-full object-cover hidden" alt="Preview">
                                    </div>
                                    <div class="drag-area w-full p-4 border-2 border-dashed @error('image') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg text-center hover:border-indigo-400 cursor-pointer">
                                        <input type="file" id="categoryImage" name="image" accept="image/*" class="hidden">
                                        <i data-lucide="upload-cloud" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Click to upload or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">PNG, JPG up to 2MB</p>
                                    </div>
                                    @error('image')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category Description</label>
                                <textarea
                                    id="description"
                                    name="description"
                                    rows="10"
                                    class="form-input w-full px-4 py-3 border @error('description') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    placeholder="Enter category description for SEO purposes..."
                                >{{ old('description') }}</textarea>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">This description helps with SEO and appears in meta tags</p>
                                @error('description')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-8 border-t flex justify-between border-gray-200 dark:border-gray-700">
                        <a href="{{route('categories.index')}}" class="px-6 py-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center">
                            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                            Back to Categories
                        </a>
                        <div class="flex space-x-3">
                            <button type="button"
                                    class="px-6 py-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                                Save as Draft
                            </button>
                            <button type="submit"
                                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center">
                                Create Category
                                <i data-lucide="plus" class="w-4 h-4 ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>


        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
@endsection
