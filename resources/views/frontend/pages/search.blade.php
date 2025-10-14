@extends('frontend.layout')

@section('title', 'Search Results' . ($search ? ' for "' . $search . '"' : ''))

@section('content')

    <!-- Search Header -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    @if($search)
                        Search Results
                    @else
                        Search Articles
                    @endif
                </h1>

                <!-- Search Form -->
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input
                        type="text"
                        name="q"
                        value="{{ $search }}"
                        placeholder="Search for articles, topics, keywords..."
                        class="w-full px-6 py-5 pr-16 text-lg rounded-full border-0 focus:ring-4 focus:ring-white/30 shadow-2xl"
                        autofocus
                    >
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>

                @if($search)
                    <p class="text-white/90 mt-4">
                        Found <strong>{{ $articles->total() }}</strong> results for "<strong>{{ $search }}</strong>"
                    </p>
                @endif
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="bg-white shadow-md sticky top-16 z-30 py-4">
        <div class="container mx-auto px-4">
            <form method="GET" class="flex flex-col lg:flex-row items-center gap-4">
                <!-- Hidden search query -->
                <input type="hidden" name="q" value="{{ $search }}">

                <!-- Category Filter -->
                <select name="category" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white w-full lg:w-auto">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Author Filter -->
                <input
                    type="text"
                    name="author"
                    value="{{ request('author') }}"
                    placeholder="Filter by author..."
                    class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 w-full lg:w-auto"
                >

                <!-- Date Range -->
                <select name="date_range" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white w-full lg:w-auto">
                    <option value="">Any Time</option>
                    <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>This Week</option>
                    <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>This Month</option>
                    <option value="year" {{ request('date_range') == 'year' ? 'selected' : '' }}>This Year</option>
                </select>

                <!-- Sort -->
                <select name="sort" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white w-full lg:w-auto">
                    <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Most Relevant</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                </select>

                <!-- Buttons -->
                <div class="flex gap-2 w-full lg:w-auto">
                    <button type="submit" class="flex-1 lg:flex-initial px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                        Apply Filters
                    </button>

                    @if(request()->hasAny(['category', 'author', 'date_range', 'sort']))
                        <a href="{{ route('search') }}?q={{ $search }}" class="flex-1 lg:flex-initial px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition text-center">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <!-- Results Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">

            @if($articles->count() > 0)

                <!-- Active Filters -->
                @if(request()->hasAny(['category', 'author', 'date_range']))
                    <div class="mb-8 flex flex-wrap items-center gap-2">
                        <span class="text-sm text-gray-600 font-semibold">Active Filters:</span>

                        @if(request('category'))
                            @php
                                $selectedCat = $categories->firstWhere('id', request('category'));
                            @endphp
                            @if($selectedCat)
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm flex items-center gap-2">
                    {{ $selectedCat->name }}
                    <a href="{{ route('search') }}?q={{ $search }}&author={{ request('author') }}&date_range={{ request('date_range') }}&sort={{ request('sort') }}" class="hover:text-blue-900">×</a>
                </span>
                            @endif
                        @endif

                        @if(request('author'))
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm flex items-center gap-2">
                Author: {{ request('author') }}
                <a href="{{ route('search') }}?q={{ $search }}&category={{ request('category') }}&date_range={{ request('date_range') }}&sort={{ request('sort') }}" class="hover:text-green-900">×</a>
            </span>
                        @endif

                        @if(request('date_range'))
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm flex items-center gap-2">
                {{ ucfirst(request('date_range')) }}
                <a href="{{ route('search') }}?q={{ $search }}&category={{ request('category') }}&author={{ request('author') }}&sort={{ request('sort') }}" class="hover:text-purple-900">×</a>
            </span>
                        @endif
                    </div>
                @endif

                <!-- Results Grid -->
                <div class="space-y-6">
                    @foreach($articles as $article)
                        <article class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition group">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <!-- Image -->
                                <div class="md:col-span-1">
                                    <div class="relative h-56 md:h-full overflow-hidden">
                                        <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/400x300' }}"
                                             alt="{{ $article->title }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="md:col-span-3 p-6">
                                    <!-- Meta -->
                                    <div class="flex flex-wrap items-center gap-4 mb-3 text-sm text-gray-600">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold">
                                {{ $article->category->name }}
                            </span>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ $article->published_at->format('M d, Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span>{{ $article->author ?? 'Admin' }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ $article->reading_time }} min read</span>
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <a href="{{ route('article.show', $article->slug) }}">
                                        <h3 class="text-2xl font-bold text-gray-900 mb-3 hover:text-indigo-600 transition">
                                            {{ $article->title }}
                                        </h3>
                                    </a>

                                    <!-- Excerpt -->
                                    <p class="text-gray-600 mb-4 line-clamp-2">
                                        {{ $article->excerpt }}
                                    </p>

                                    <!-- Tags -->
                                    @if($article->tags && $article->tags->count() > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($article->tags->take(3) as $tag)
                                                <a href="{{ route('tag.show', $tag->slug) }}"
                                                   class="px-2 py-1 bg-gray-100 hover:bg-indigo-100 text-gray-600 hover:text-indigo-600 rounded text-xs transition">
                                                    #{{ $tag->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $articles->appends(request()->query())->links() }}
                </div>

            @else
                <!-- No Results -->
                <div class="text-center py-16">
                    <div class="flex justify-center mb-6">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Results Found</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        @if($search)
                            We couldn't find any articles matching "{{ $search }}". Try different keywords or adjust your filters.
                        @else
                            Please enter a search query to find articles.
                        @endif
                    </p>
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('search') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                            New Search
                        </a>
                        <a href="{{ route('front_home') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition">
                            Back to Home
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Popular Searches / Suggestions -->
    @if($search && $articles->count() == 0)
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Try These Popular Topics</h2>
                    <div class="flex flex-wrap gap-3">
                        @php
                            $popularTopics = ['Technology', 'Business', 'Health', 'Sports', 'Entertainment', 'Politics', 'Science'];
                        @endphp
                        @foreach($popularTopics as $topic)
                            <a href="{{ route('search') }}?q={{ strtolower($topic) }}"
                               class="px-6 py-3 bg-gray-100 hover:bg-indigo-100 text-gray-700 hover:text-indigo-600 rounded-lg font-medium transition">
                                {{ $topic }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
