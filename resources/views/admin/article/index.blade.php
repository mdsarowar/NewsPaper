{{--@extends('admin.master')--}}

{{--@section('content')--}}
{{--    <div class="space-y-6">--}}
{{--        Page Header--}}
{{--        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">--}}
{{--            <div>--}}
{{--                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Articles</h1>--}}
{{--                <p class="text-gray-600 dark:text-gray-400 mt-1">Manage your news articles and content</p>--}}
{{--            </div>--}}

{{--            <div class="flex items-center space-x-3">--}}
{{--                <a href="{{ route('articles.create') }}"--}}
{{--                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center">--}}
{{--                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>--}}
{{--                    Add Article--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        Flash Messages--}}
{{--        @if(session('success'))--}}
{{--            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 flex items-start">--}}
{{--                <i data-lucide="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400 mr-3 mt-0.5"></i>--}}
{{--                <div class="flex-1">--}}
{{--                    <h4 class="text-sm font-medium text-green-800 dark:text-green-300">Success!</h4>--}}
{{--                    <p class="text-sm text-green-700 dark:text-green-400 mt-1">{{ session('success') }}</p>--}}
{{--                </div>--}}
{{--                <button onclick="this.parentElement.remove()" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300">--}}
{{--                    <i data-lucide="x" class="w-5 h-5"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        @if(session('error'))--}}
{{--            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 flex items-start">--}}
{{--                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 dark:text-red-400 mr-3 mt-0.5"></i>--}}
{{--                <div class="flex-1">--}}
{{--                    <h4 class="text-sm font-medium text-red-800 dark:text-red-300">Error!</h4>--}}
{{--                    <p class="text-sm text-red-700 dark:text-red-400 mt-1">{{ session('error') }}</p>--}}
{{--                </div>--}}
{{--                <button onclick="this.parentElement.remove()" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">--}}
{{--                    <i data-lucide="x" class="w-5 h-5"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        Stats Cards--}}
{{--        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">--}}
{{--            Total Articles--}}
{{--            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-800">--}}
{{--                <div class="flex items-center justify-between">--}}
{{--                    <div>--}}
{{--                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Articles</p>--}}
{{--                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ $totalArticles ?? 0 }}</p>--}}
{{--                    </div>--}}
{{--                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">--}}
{{--                        <i data-lucide="file-text" class="w-6 h-6 text-blue-600"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            Published Articles--}}
{{--            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-800">--}}
{{--                <div class="flex items-center justify-between">--}}
{{--                    <div>--}}
{{--                        <p class="text-sm text-gray-600 dark:text-gray-400">Published</p>--}}
{{--                        <p class="text-2xl font-bold text-green-600 mt-1">{{ $publishedArticles ?? 0 }}</p>--}}
{{--                    </div>--}}
{{--                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">--}}
{{--                        <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            Draft Articles--}}
{{--            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-800">--}}
{{--                <div class="flex items-center justify-between">--}}
{{--                    <div>--}}
{{--                        <p class="text-sm text-gray-600 dark:text-gray-400">Drafts</p>--}}
{{--                        <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $draftArticles ?? 0 }}</p>--}}
{{--                    </div>--}}
{{--                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">--}}
{{--                        <i data-lucide="edit" class="w-6 h-6 text-yellow-600"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            Featured Articles--}}
{{--            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-800">--}}
{{--                <div class="flex items-center justify-between">--}}
{{--                    <div>--}}
{{--                        <p class="text-sm text-gray-600 dark:text-gray-400">Featured</p>--}}
{{--                        <p class="text-2xl font-bold text-purple-600 mt-1">{{ $featuredArticles ?? 0 }}</p>--}}
{{--                    </div>--}}
{{--                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">--}}
{{--                        <i data-lucide="star" class="w-6 h-6 text-purple-600"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        Filters--}}
{{--        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">--}}
{{--            <div class="p-6">--}}
{{--                <form method="GET" action="{{ route('articles.index') }}" class="flex flex-col lg:flex-row lg:items-end gap-4">--}}

{{--                    Search--}}
{{--                    <div class="flex-1">--}}
{{--                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>--}}
{{--                        <div class="relative">--}}
{{--                            <i data-lucide="search" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>--}}
{{--                            <input type="text"--}}
{{--                                   name="search"--}}
{{--                                   value="{{ request('search') }}"--}}
{{--                                   placeholder="Search by title, author..."--}}
{{--                                   class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    Status Filter--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>--}}
{{--                        <select name="status" class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">--}}
{{--                            <option value="">All Status</option>--}}
{{--                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>--}}
{{--                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>--}}
{{--                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    Category Filter--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>--}}
{{--                        <select name="category" class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">--}}
{{--                            <option value="">All Categories</option>--}}
{{--                            @foreach($categories ?? [] as $category)--}}
{{--                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>--}}
{{--                                    {{ $category->name }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    Featured Filter--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>--}}
{{--                        <select name="type" class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">--}}
{{--                            <option value="">All Types</option>--}}
{{--                            <option value="featured" {{ request('type') == 'featured' ? 'selected' : '' }}>Featured</option>--}}
{{--                            <option value="breaking" {{ request('type') == 'breaking' ? 'selected' : '' }}>Breaking News</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    Sort By--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort By</label>--}}
{{--                        <select name="sort" class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">--}}
{{--                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Created Date</option>--}}
{{--                            <option value="published_at" {{ request('sort') == 'published_at' ? 'selected' : '' }}>Published Date</option>--}}
{{--                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>--}}
{{--                            <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>Views</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    Action Buttons--}}
{{--                    <div class="flex space-x-2">--}}
{{--                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center">--}}
{{--                            <i data-lucide="filter" class="w-4 h-4 mr-2"></i>--}}
{{--                            Filter--}}
{{--                        </button>--}}

{{--                        <a href="{{ route('articles.index') }}" class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">--}}
{{--                            Clear--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        Articles Table--}}
{{--        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">--}}

{{--            Table Header--}}
{{--            <div class="p-6 border-b border-gray-200 dark:border-gray-800">--}}
{{--                <div class="flex items-center justify-between">--}}
{{--                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">--}}
{{--                        <i data-lucide="list" class="w-5 h-5 mr-2 text-indigo-600"></i>--}}
{{--                        All Articles--}}
{{--                    </h3>--}}
{{--                    <div class="text-sm text-gray-600 dark:text-gray-400">--}}
{{--                        Showing <span class="font-semibold">{{ $articles->firstItem() ?? 0 }}</span> to--}}
{{--                        <span class="font-semibold">{{ $articles->lastItem() ?? 0 }}</span> of--}}
{{--                        <span class="font-semibold">{{ $articles->total() ?? 0 }}</span> results--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            Table Content--}}
{{--            <div class="overflow-x-auto">--}}
{{--                <table class="w-full">--}}
{{--                    <thead class="bg-gray-50 dark:bg-gray-800">--}}
{{--                    <tr>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">--}}
{{--                            <input type="checkbox" class="rounded border-gray-300 dark:border-gray-600">--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">--}}
{{--                            Image--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">--}}
{{--                            Article--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">--}}
{{--                            Category--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">--}}
{{--                            Author--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">--}}
{{--                            Status--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">--}}
{{--                            Stats--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">--}}
{{--                            Published--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">--}}
{{--                            Actions--}}
{{--                        </th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">--}}
{{--                    @forelse($articles as $article)--}}
{{--                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">--}}
{{--                            Checkbox--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                <input type="checkbox" class="rounded border-gray-300 dark:border-gray-600">--}}
{{--                            </td>--}}

{{--                            Image--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                @if($article->image)--}}
{{--                                    <img src="{{ asset('storage/' . $article->image) }}"--}}
{{--                                         alt="{{ $article->title }}"--}}
{{--                                         class="w-16 h-12 rounded-lg object-cover">--}}
{{--                                @else--}}
{{--                                    <div class="w-16 h-12 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">--}}
{{--                                        <i data-lucide="image" class="w-6 h-6 text-gray-400"></i>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            </td>--}}

{{--                            Article Title & Badges--}}
{{--                            <td class="px-6 py-4">--}}
{{--                                <div class="flex flex-col">--}}
{{--                                    <div class="font-medium text-gray-900 dark:text-gray-100 max-w-xs truncate">--}}
{{--                                        {{ $article->title }}--}}
{{--                                    </div>--}}
{{--                                    <div class="flex items-center gap-2 mt-1">--}}
{{--                                        @if($article->is_featured)--}}
{{--                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300">--}}
{{--                                                <i data-lucide="star" class="w-3 h-3 mr-1"></i>--}}
{{--                                                Featured--}}
{{--                                            </span>--}}
{{--                                        @endif--}}
{{--                                        @if($article->is_breaking)--}}
{{--                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">--}}
{{--                                                <i data-lucide="zap" class="w-3 h-3 mr-1"></i>--}}
{{--                                                Breaking--}}
{{--                                            </span>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </td>--}}

{{--                            Category--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                @if($article->category)--}}
{{--                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">--}}
{{--                                        {{ $article->category->name }}--}}
{{--                                    </span>--}}
{{--                                @else--}}
{{--                                    <span class="text-sm text-gray-500 dark:text-gray-400">—</span>--}}
{{--                                @endif--}}
{{--                            </td>--}}

{{--                            Author--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                <div class="flex items-center">--}}
{{--                                    <div class="text-sm text-gray-900 dark:text-gray-100">--}}
{{--                                        {{ $article->author ?? $article->user->name ?? 'Unknown' }}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </td>--}}

{{--                            Status--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                @if($article->status == 'published')--}}
{{--                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">--}}
{{--                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>--}}
{{--                                        Published--}}
{{--                                    </span>--}}
{{--                                @elseif($article->status == 'draft')--}}
{{--                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">--}}
{{--                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>--}}
{{--                                        Draft--}}
{{--                                    </span>--}}
{{--                                @else--}}
{{--                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300">--}}
{{--                                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-1.5"></span>--}}
{{--                                        Archived--}}
{{--                                    </span>--}}
{{--                                @endif--}}
{{--                            </td>--}}

{{--                            Stats--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                <div class="flex flex-col text-sm">--}}
{{--                                    <div class="flex items-center text-gray-600 dark:text-gray-400">--}}
{{--                                        <i data-lucide="eye" class="w-3 h-3 mr-1"></i>--}}
{{--                                        {{ $article->views ?? 0 }} views--}}
{{--                                    </div>--}}
{{--                                    <div class="flex items-center text-gray-600 dark:text-gray-400 mt-1">--}}
{{--                                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i>--}}
{{--                                        {{ $article->reading_time ?? 0 }} min read--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </td>--}}

{{--                            Published Date--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">--}}
{{--                                @if($article->published_at)--}}
{{--                                    {{ \Carbon\Carbon::parse($article->published_at)->format('M d, Y') }}--}}
{{--                                @else--}}
{{--                                    <span class="text-gray-400">Not published</span>--}}
{{--                                @endif--}}
{{--                            </td>--}}

{{--                            Actions--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">--}}
{{--                                <div class="flex items-center justify-end space-x-2">--}}
{{--                                    <a href="{{ route('articles.show', $article->id) }}"--}}
{{--                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300"--}}
{{--                                       title="View">--}}
{{--                                        <i data-lucide="eye" class="w-4 h-4"></i>--}}
{{--                                    </a>--}}

{{--                                    <a href="{{ route('articles.edit', $article->id) }}"--}}
{{--                                       class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300"--}}
{{--                                       title="Edit">--}}
{{--                                        <i data-lucide="edit" class="w-4 h-4"></i>--}}
{{--                                    </a>--}}

{{--                                    <form action="{{ route('articles.destroy', $article->id) }}"--}}
{{--                                          method="POST"--}}
{{--                                          class="inline"--}}
{{--                                          onsubmit="return confirm('Are you sure you want to delete this article?');">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit"--}}
{{--                                                class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300"--}}
{{--                                                title="Delete">--}}
{{--                                            <i data-lucide="trash-2" class="w-4 h-4"></i>--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="9" class="px-6 py-12 text-center">--}}
{{--                                <div class="flex flex-col items-center justify-center">--}}
{{--                                    <i data-lucide="file-x" class="w-12 h-12 text-gray-400 mb-4"></i>--}}
{{--                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-1">No articles found</h3>--}}
{{--                                    <p class="text-gray-500 dark:text-gray-400 mb-4">Get started by creating a new article.</p>--}}
{{--                                    <a href="{{ route('articles.create') }}"--}}
{{--                                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center">--}}
{{--                                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>--}}
{{--                                        Add Article--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}

{{--            Pagination--}}
{{--            @if($articles->hasPages())--}}
{{--                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-800">--}}
{{--                    {{ $articles->links() }}--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <script>--}}
{{--        // Initialize Lucide icons--}}
{{--        if (typeof lucide !== 'undefined') {--}}
{{--            lucide.createIcons();--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}



@extends('admin.master')

@section('content')
    <div class="space-y-6">
        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Articles</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Manage your news articles and content</p>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('articles.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    Add Article
                </a>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 flex items-start">
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
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 flex items-start">
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

        {{-- Stats Cards --}}

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Articles</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ $totalArticles ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="file-text" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
            </div>


            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Published</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">{{ $publishedArticles ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
            </div>


            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Drafts</p>
                        <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $draftArticles ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="edit" class="w-6 h-6 text-yellow-600"></i>
                    </div>
                </div>
            </div>


            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Featured</p>
                        <p class="text-2xl font-bold text-purple-600 mt-1">{{ $featuredArticles ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="star" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">--}}
{{--            --}}{{-- Single Card --}}
{{--            <x-admin.stat-card title="Total Articles" :value="$totalArticles ?? 0" color="blue" icon="file-text" />--}}
{{--            <x-admin.stat-card title="Published" :value="$publishedArticles ?? 0" color="green" icon="check-circle" />--}}
{{--            <x-admin.stat-card title="Drafts" :value="$draftArticles ?? 0" color="yellow" icon="edit" />--}}
{{--            <x-admin.stat-card title="Featured" :value="$featuredArticles ?? 0" color="purple" icon="star" />--}}
{{--        </div>--}}

        {{-- Filters --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">
            <div class="p-6">
                <form method="GET" action="{{ route('articles.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                    {{-- Search --}}
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                        <div class="relative">
                            <i data-lucide="search" class="absolute left-3 top-3 w-5 h-5 text-gray-400"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Search by title, author..."
                                   class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                        </div>
                    </div>

                    {{-- Dropdown Filters --}}
                    @foreach([
                        'status' => ['All Status','published'=>'Published','draft'=>'Draft','archived'=>'Archived'],
                        'category' => $categories->pluck('name','id')->prepend('All Categories',''),
                        'type' => ['All Types','featured'=>'Featured','breaking'=>'Breaking News'],
                        'sort' => ['created_at'=>'Created Date','published_at'=>'Published Date','title'=>'Title','views'=>'Views']
                    ] as $name => $options)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 capitalize">{{ $name }}</label>
                            <select name="{{ $name }}" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                                @foreach($options as $key => $value)
                                    <option value="{{ is_int($key)? '' : $key }}" {{ request($name)==$key?'selected':'' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach

                    {{-- Actions --}}
                    <div class="flex space-x-2 lg:col-span-6">
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center justify-center w-full sm:w-auto">
                            <i data-lucide="filter" class="w-4 h-4 mr-2"></i> Filter
                        </button>
                        <a href="{{ route('articles.index') }}" class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 w-full sm:w-auto text-center">
                            Clear
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Articles Table --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
            {{-- Table Header --}}
            <div class="p-4 sm:p-6 border-b border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center mb-2 sm:mb-0">
                    <i data-lucide="list" class="w-5 h-5 mr-2 text-indigo-600"></i>
                    All Articles
                </h3>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Showing <b>{{ $articles->firstItem() ?? 0 }}</b> to <b>{{ $articles->lastItem() ?? 0 }}</b> of <b>{{ $articles->total() ?? 0 }}</b>
                </div>
            </div>

            {{-- Responsive Table --}}
            <div class="overflow-x-auto w-full">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                    <thead class="bg-gray-50 dark:bg-gray-800 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Image</th>
                        <th class="px-4 py-3 text-left">Article</th>
                        <th class="px-4 py-3 text-left hidden md:table-cell">Category</th>
                        <th class="px-4 py-3 text-left hidden md:table-cell">Author</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left hidden lg:table-cell">Stats</th>
                        <th class="px-4 py-3 text-left hidden sm:table-cell">Published</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($articles as $article)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <td class="px-4 py-4">
                                <input type="checkbox" class="rounded border-gray-300 dark:border-gray-600">
                            </td>
                            <td class="px-4 py-4">
                                @if($article->image)
                                    <img src="{{ asset('storage/'.$article->image) }}" class="w-14 h-10 rounded object-cover" alt="">
                                @else
                                    <div class="w-14 h-10 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                                        <i data-lucide="image" class="w-5 h-5 text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm">
                                <div class="font-medium text-gray-900 dark:text-gray-100 truncate">{{ $article->title }}</div>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @if($article->is_featured)
                                        <span class="badge bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300">Featured</span>
                                    @endif
                                    @if($article->is_breaking)
                                        <span class="badge bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">Breaking</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4 hidden md:table-cell">
                                {{ $article->category->name ?? '—' }}
                            </td>
                            <td class="px-4 py-4 hidden md:table-cell">
                                {{ $article->author ?? $article->user->name ?? 'Unknown' }}
                            </td>
                            <td class="px-4 py-4">
                                <span class="capitalize text-sm {{ $article->status == 'published' ? 'text-green-600' : ($article->status == 'draft' ? 'text-yellow-600' : 'text-gray-500') }}">
                                    {{ $article->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 hidden lg:table-cell text-gray-500 dark:text-gray-400 text-sm">
                                {{ $article->views ?? 0 }} views
                            </td>
                            <td class="px-4 py-4 hidden sm:table-cell text-gray-500 dark:text-gray-400 text-sm">
                                {{ $article->published_at ? $article->published_at->format('M d, Y') : '—' }}
                            </td>
                            <td class="px-4 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('articles.show', $article->id) }}" class="text-blue-500 hover:text-blue-700">
                                        <i data-lucide="eye" class="w-4 h-4">view</i>
                                    </a>
                                    <a href="{{ route('articles.edit', $article->id) }}" class="text-indigo-500 hover:text-indigo-700">
                                        <i data-lucide="edit" class="w-4 h-4">edit</i>
                                    </a>
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Delete this article?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i data-lucide="trash-2" class="w-4 h-4">delete</i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                No articles found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($articles->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-800">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
@endsection
