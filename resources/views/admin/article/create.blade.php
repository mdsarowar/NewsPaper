@extends('admin.master')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Create New Article</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Write and publish your news article</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('articles.index') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center">
                        <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                        Cancel
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

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content - Left Side (2 columns) -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Basic Information Card -->
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Basic Information</h3>

                        <!-- 4 Column Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                            <!-- Title (Full Width) -->
                            <div class="md:col-span-2 lg:col-span-4">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Article Title *</label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    required
                                    value="{{ old('title') }}"
                                    class="form-input w-full px-4 py-3 border @error('title') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    placeholder="Enter article title"
                                >
                                @error('title')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Breaking Title (conditional, 2 columns) -->
                            <div id="breakingTitleField" class=" md:col-span-2 lg:col-span-4">
                                <label for="breaking_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Breaking News Title</label>
                                <input
                                    type="text"
                                    id="breaking_title"
                                    name="breaking_title"
                                    value="{{ old('breaking_title') }}"
                                    class="form-input w-full px-4 py-3 border @error('breaking_title') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    placeholder="Breaking news headline"
                                >
                                @error('breaking_title')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

{{--                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">--}}
                                <!-- Main Image -->
                                <div class="md:col-span-2 ">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Main Image</label>
                                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center mb-4 overflow-hidden" id="mainImagePreview">
                                        <i data-lucide="image" class="w-12 h-12 text-gray-400" id="mainDefaultIcon"></i>
                                        <img id="mainPreviewImg" class="w-full h-full object-cover hidden" alt="Preview">
                                    </div>
                                    <div class="drag-area w-full p-4 border-2 border-dashed @error('image') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg text-center hover:border-indigo-400 cursor-pointer" onclick="document.getElementById('mainImage').click()">
                                        <input type="file" id="mainImage" name="image" accept="image/*" class="hidden">
                                        <i data-lucide="upload-cloud" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Click to upload</p>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG up to 2MB</p>
                                    </div>
                                    @error('image')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Featured Image -->
                                <div class="md:col-span-2 ">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Featured Image</label>
                                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center mb-4 overflow-hidden" id="featuredImagePreview">
                                        <i data-lucide="image" class="w-12 h-12 text-gray-400" id="featuredDefaultIcon"></i>
                                        <img id="featuredPreviewImg" class="w-full h-full object-cover hidden" alt="Preview">
                                    </div>
                                    <div class="drag-area w-full p-4 border-2 border-dashed @error('featured_image') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg text-center hover:border-indigo-400 cursor-pointer" onclick="document.getElementById('featuredImage').click()">
                                        <input type="file" id="featuredImage" name="featured_image" accept="image/*" class="hidden">
                                        <i data-lucide="upload-cloud" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Click to upload</p>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG up to 2MB</p>
                                    </div>
                                    @error('featured_image')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
{{--                            </div>--}}

                            <!-- Category -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category *</label>
                                <div class="relative">
                                    <i data-lucide="folder" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                    <select
                                        id="category_id"
                                        name="category_id"
                                        required
                                        class="form-input w-full pl-10 pr-4 py-3 border @error('category_id') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    >
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
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
                                        class="form-input w-full pl-10 pr-4 py-3 border @error('status') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    >
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                </div>
                                @error('status')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Author -->
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Author Name</label>
                                <div class="relative">
                                    <i data-lucide="user" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                    <input
                                        type="text"
                                        id="author"
                                        name="author"
                                        value="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                        class="form-input w-full pl-10 pr-4 py-3 border @error('author') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                        placeholder="Author name"
                                    >
                                </div>
                                @error('author')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Published At -->
                            <div>
                                <label for="published_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Publish Date</label>
                                <div class="relative">
                                    <i data-lucide="calendar" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                                    <input
                                        type="datetime-local"
                                        id="published_at"
                                        name="published_at"
                                        value="{{ old('published_at') }}"
                                        class="form-input w-full pl-10 pr-4 py-3 border @error('published_at') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    >
                                </div>
                                @error('published_at')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- Reading Time -->
{{--                            <div>--}}
{{--                                <label for="reading_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Reading Time (min)</label>--}}
{{--                                <div class="relative">--}}
{{--                                    <i data-lucide="clock" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>--}}
{{--                                    <input--}}
{{--                                        type="number"--}}
{{--                                        id="reading_time"--}}
{{--                                        name="reading_time"--}}
{{--                                        value="{{ old('reading_time') }}"--}}
{{--                                        min="1"--}}
{{--                                        class="form-input w-full pl-10 pr-4 py-3 border @error('reading_time') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"--}}
{{--                                        placeholder="5"--}}
{{--                                    >--}}
{{--                                </div>--}}
{{--                                @error('reading_time')--}}
{{--                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

                            <!-- Features Checkboxes (2 columns) -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Features</label>
                                <div class="flex flex-wrap gap-4">
                                    <!-- Featured Article -->
                                    <div class="flex items-center">
                                        <input
                                            type="checkbox"
                                            id="is_featured"
                                            name="is_featured"
                                            value="1"
                                            {{ old('is_featured') ? 'checked' : '' }}
                                            class="w-4 h-4 text-indigo-600 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500"
                                        >
                                        <label for="is_featured" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                            Featured
                                        </label>
                                    </div>

                                    <!-- Breaking News -->
                                    <div class="flex items-center">
                                        <input
                                            type="checkbox"
                                            id="is_breaking"
                                            name="is_breaking"
                                            value="1"
                                            {{ old('is_breaking') ? 'checked' : '' }}
                                            class="w-4 h-4 text-red-600 border-gray-300 dark:border-gray-600 rounded focus:ring-red-500"
                                            onchange="document.getElementById('breakingTitleField').classList.toggle('hidden')"
                                        >
                                        <label for="is_breaking" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                            Breaking News
                                        </label>
                                    </div>

                                    <!-- Allow Comments -->
                                    <div class="flex items-center">
                                        <input
                                            type="checkbox"
                                            id="allow_comments"
                                            name="allow_comments"
                                            value="1"
                                            {{ old('allow_comments', true) ? 'checked' : '' }}
                                            class="w-4 h-4 text-indigo-600 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500"
                                        >
                                        <label for="allow_comments" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                            Allow Comments
                                        </label>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- Tags Input -->
                        <div class="mb-6 md:col-span-2 lg:col-span-4">
                            <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tags</label>
                            <input
                                id="tags"
                                name="tags"
                                value="{{ old('tags') }}"
                                placeholder="Type and press Enter..."
                                class="form-input w-full px-4 py-3 border @error('tags') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                            >
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Type a tag and press <strong>Enter</strong> to add</p>
                            @error('tags')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Excerpt (2 columns) -->
                        <div class="mb-6">
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Excerpt (Short Summary)</label>
                            <textarea
                                id="excerpt"
                                name="excerpt"
                                rows="3"
                                class="form-input w-full px-4 py-3 border @error('excerpt') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                placeholder="Brief summary of the article..."
                            >{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Article Content *</label>
                            <textarea
                                id="content"
                                name="content"
                                rows="15"
                                required
                                class="form-input w-full px-4 py-3 border @error('content') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                placeholder="Write your article content here..."
                            >{{ old('content') }}</textarea>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">You can use a rich text editor here</p>
                            @error('content')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Images Card (2 columns) -->


                    <!-- Submit Buttons -->
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6">
                        <div class="flex flex-col sm:flex-row gap-3 justify-between">
                            <a href="{{ route('articles.index') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 flex items-center justify-center">
                                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                Back to Articles
                            </a>

                            <div class="flex gap-3">
                                <button type="button" onclick="document.getElementById('status').value='draft'; this.form.submit();" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 flex items-center justify-center">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    Save as Draft
                                </button>

                                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center justify-center">
                                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                                    Publish Article
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- SEO Sidebar - Right Side (1 column) -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 sticky top-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">SEO & Meta</h3>

                        <div class="space-y-4">
                            <!-- Meta Title -->
                            <div>
                                <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Title</label>
                                <input
                                    type="text"
                                    id="meta_title"
                                    name="meta_title"
                                    value="{{ old('meta_title') }}"
                                    class="form-input w-full px-4 py-2.5 border @error('meta_title') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    placeholder="SEO optimized title"
                                >
                                @error('meta_title')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Meta Description -->
                            <div>
                                <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Description</label>
                                <textarea
                                    id="meta_description"
                                    name="meta_description"
                                    rows="4"
                                    class="form-input w-full px-4 py-2.5 border @error('meta_description') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    placeholder="Brief description for search engines..."
                                >{{ old('meta_description') }}</textarea>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Recommended: 150-160 characters</p>
                                @error('meta_description')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Meta Keywords -->
                            <div>
                                <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Keywords</label>
                                <input
                                    type="text"
                                    id="meta_keywords"
                                    name="meta_keywords"
                                    value="{{ old('meta_keywords') }}"
                                    class="form-input w-full px-4 py-2.5 border @error('meta_keywords') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                    placeholder="keyword1, keyword2, keyword3"
                                >
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Separate keywords with commas</p>
                                @error('meta_keywords')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- SEO Tips -->
                            <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <h4 class="text-sm font-medium text-blue-900 dark:text-blue-300 mb-2 flex items-center">
                                    <i data-lucide="lightbulb" class="w-4 h-4 mr-2"></i>
                                    SEO Tips
                                </h4>
                                <ul class="text-xs text-blue-800 dark:text-blue-300 space-y-1">
                                    <li>• Keep title under 60 characters</li>
                                    <li>• Description: 150-160 characters</li>
                                    <li>• Use relevant keywords naturally</li>
                                    <li>• Make meta title unique</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Tagify CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <script>
        // Initialize Tagify on the input
        var input = document.querySelector('#tags');
        var tagify = new Tagify(input, {
            whitelist: [
                @foreach($tags as $tag)
                    "{{ $tag->name }}",
                @endforeach
            ],
            dropdown: {
                maxItems: 10,
                classname: "tags-look",
                enabled: 0,
                closeOnSelect: false
            }
        });
    </script>
    <script>
        // Main Image Preview
        document.getElementById('mainImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('mainPreviewImg').src = e.target.result;
                    document.getElementById('mainPreviewImg').classList.remove('hidden');
                    document.getElementById('mainDefaultIcon').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Featured Image Preview
        document.getElementById('featuredImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('featuredPreviewImg').src = e.target.result;
                    document.getElementById('featuredPreviewImg').classList.remove('hidden');
                    document.getElementById('featuredDefaultIcon').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Show breaking title field if breaking news is checked on page load
        if (document.getElementById('is_breaking').checked) {
            document.getElementById('breakingTitleField').classList.remove('hidden');
        }

        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
@endsection
