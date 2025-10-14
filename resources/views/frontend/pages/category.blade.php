@extends('frontend.layout')

@section('title', $category->name . ' - Articles')
@section('description', $category->description ?? 'Browse ' . $category->name . ' articles')

@section('content')

    <!-- Category Header -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 text-sm text-white/80 mb-4">
                    <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                    <span>/</span>
                    <span class="text-white">{{ $category->name }}</span>
                </nav>

                <!-- Category Title -->
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    {{ $category->name }}
                </h1>

                @if($category->description)
                    <p class="text-lg text-white/90 mb-6">
                        {{ $category->description }}
                    </p>
                @endif

                <div class="flex items-center gap-6 text-white/90">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>{{ $articles->total() }} Articles</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Bar -->
    <section class="bg-white shadow-md sticky top-16 z-30 py-4">
        <div class="container mx-auto px-4">
            <form method="GET" class="flex flex-col md:flex-row items-center justify-between gap-4">
                <!-- Search in Category -->
                <div class="relative flex-1 w-full md:max-w-md">
                    <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search in {{ $category->name }}..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <!-- Filter Options -->
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <!-- Sort By -->
                    <select name="sort" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                        <option value="trending" {{ request('sort') == 'trending' ? 'selected' : '' }}>Trending</option>
                    </select>

                    <!-- Apply Button -->
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        Apply
                    </button>

                    <!-- Reset -->
                    @if(request()->hasAny(['search', 'sort']))
                        <a href="{{ route('category.show', $category->slug) }}" class="px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <!-- Articles Grid -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">

            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $article)
                        <article class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 group">
                            <!-- Image -->
                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/400x300' }}"
                                     alt="{{ $article->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                                <!-- Badges -->
                                <div class="absolute top-4 left-4 flex gap-2">
                                    @if($article->is_featured)
                                        <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-semibold rounded-full">
                            ⭐ Featured
                        </span>
                                    @endif
                                    @if($article->is_breaking)
                                        <span class="px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-full animate-pulse">
                            🔴 Breaking
                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Meta -->
                                <div class="flex items-center gap-3 mb-3 text-xs text-gray-500">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>{{ $article->published_at->format('M d, Y') }}</span>
                                    </div>
                                    <span>•</span>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $article->reading_time }} min read</span>
                                    </div>
                                </div>

                                <!-- Title -->
                                <a href="{{ route('article.show', $article->slug) }}">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 hover:text-blue-600 transition">
                                        {{ $article->title }}
                                    </h3>
                                </a>

                                <!-- Excerpt -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ $article->excerpt }}
                                </p>

                                <!-- Author & Read More -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author ?? 'Admin') }}&background=random&size=32"
                                             class="w-8 h-8 rounded-full" alt="Author">
                                        <span class="text-sm font-medium text-gray-700">{{ $article->author ?? 'Admin' }}</span>
                                    </div>
                                    <a href="{{ route('article.show', $article->slug) }}"
                                       class="text-blue-600 hover:text-blue-700 text-sm font-semibold flex items-center gap-1 group-hover:gap-2 transition-all">
                                        Read More →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $articles->links() }}
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="flex justify-center mb-6">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Articles Found</h3>
                    <p class="text-gray-600 mb-6">
                        @if(request('search'))
                            No articles match your search "{{ request('search') }}"
                        @else
                            There are no articles in this category yet.
                        @endif
                    </p>
                    <a href="{{ route('front_home') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        Back to Home
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Related Categories -->
    @php
        $relatedCategories = \App\Models\Category::where('status', 'active')
            ->where('id', '!=', $category->id)
            ->withCount(['articles' => function($query) {
                $query->where('status', 'published');
            }])
            ->having('articles_count', '>', 0)
            ->take(4)
            ->get();
    @endphp

    @if($relatedCategories->count() > 0)
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Explore Other Categories</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedCategories as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}"
                           class="p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl hover:shadow-lg transition group">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-600 transition">
                                    <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition">{{ $cat->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $cat->articles_count }} Articles</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
