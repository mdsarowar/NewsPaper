@extends('frontend.layout')

@section('title', 'Home - Latest News & Articles')

@section('content')

    <!-- Breaking News Ticker -->
    @if($breakingNews && $breakingNews->count() > 0)
        <div class="bg-red-600 text-white py-3 sticky top-0 z-40 shadow-lg">
            <div class="container mx-auto px-4">
                <div class="flex items-center">
            <span class="bg-white text-red-600 px-4 py-1 rounded-full font-bold text-sm mr-4 flex-shrink-0">
                🔴 BREAKING
            </span>
                    <div class="breaking-news-slider overflow-hidden flex-1">
                        <div class="breaking-news-content whitespace-nowrap animate-marquee">
                            @foreach($breakingNews as $news)
                                <a href="{{ route('article.show', $news->slug) }}" class="inline-block mr-12 hover:underline">
                                    {{ $news->breaking_title ?? $news->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Hero Section - Featured Articles -->
    <section class="bg-gradient-to-br from-gray-50 to-gray-100 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Main Featured Article -->
                @if(isset($featuredArticles[0]))
                    <div class="lg:col-span-8">
                        <article class="relative h-[600px] rounded-2xl overflow-hidden shadow-2xl group cursor-pointer transform hover:scale-[1.02] transition-all duration-500">
                            <img src="{{ $featuredArticles[0]->featured_image ? asset('storage/' . $featuredArticles[0]->featured_image) : asset('storage/' . $featuredArticles[0]->image) }}"
                                 alt="{{ $featuredArticles[0]->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>

                            <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                                <div class="flex items-center gap-4 mb-4">
                                    <span class="px-4 py-1 bg-red-600 rounded-full text-sm font-semibold">Featured</span>
                                    <span class="px-4 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm">
                                {{ $featuredArticles[0]->category->name }}
                            </span>
                                </div>

                                <a href="{{ route('article.show', $featuredArticles[0]->slug) }}">
                                    <h2 class="text-4xl md:text-5xl font-bold mb-4 leading-tight hover:text-yellow-400 transition">
                                        {{ $featuredArticles[0]->title }}
                                    </h2>
                                </a>

                                <p class="text-lg text-gray-200 mb-4 line-clamp-2">
                                    {{ $featuredArticles[0]->excerpt }}
                                </p>

                                <div class="flex items-center gap-6 text-sm text-gray-300">
                                    <div class="flex items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($featuredArticles[0]->author ?? 'Admin') }}&background=random"
                                             class="w-8 h-8 rounded-full" alt="Author">
                                        <span>{{ $featuredArticles[0]->author ?? 'Admin' }}</span>
                                    </div>
                                    <span>{{ $featuredArticles[0]->published_at->format('M d, Y') }}</span>
                                    <span>{{ $featuredArticles[0]->reading_time }} min read</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endif

                <!-- Side Featured Articles -->
                <div class="lg:col-span-4 space-y-6">
                    @foreach($featuredArticles->skip(1)->take(2) as $article)
                        <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 group">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/400x300' }}"
                                     alt="{{ $article->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <span class="absolute top-4 left-4 px-3 py-1 bg-blue-600 text-white text-xs rounded-full">
                            {{ $article->category->name }}
                        </span>
                            </div>
                            <div class="p-5">
                                <a href="{{ route('article.show', $article->slug) }}">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 hover:text-blue-600 transition">
                                        {{ $article->title }}
                                    </h3>
                                </a>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    {{ $article->excerpt }}
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span>{{ $article->published_at->diffForHumans() }}</span>
                                    <span>{{ $article->reading_time }} min</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Articles -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 flex items-center gap-3">
                    <span class="w-2 h-10 bg-blue-600 rounded-full"></span>
                    Latest Articles
                </h2>
                <a href="{{ route('articles_all') }}" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2 group">
                    View All
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestArticles as $article)
                    <article class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 group border border-gray-100">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/400x300' }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                            <div class="absolute top-4 left-4 flex gap-2">
                        <span class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full">
                            {{ $article->category->name }}
                        </span>
                                @if($article->is_featured)
                                    <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-semibold rounded-full">
                            ⭐ Featured
                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3 text-xs text-gray-500">
                                <span>{{ $article->published_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <span>{{ $article->reading_time }} min read</span>
                            </div>

                            <a href="{{ route('article.show', $article->slug) }}">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 hover:text-blue-600 transition">
                                    {{ $article->title }}
                                </h3>
                            </a>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ $article->excerpt }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author ?? 'Admin') }}&background=random&size=32"
                                         class="w-8 h-8 rounded-full" alt="Author">
                                    <span class="text-sm font-medium text-gray-700">{{ $article->author ?? 'Admin' }}</span>
                                </div>
                                <a href="{{ route('article.show', $article->slug) }}"
                                   class="text-blue-600 hover:text-blue-700 text-sm font-semibold flex items-center gap-1">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Category Wise Articles -->
    @foreach($categoryArticles as $category => $articles)
        @if($articles->count() > 0)
            <section class="py-12 bg-gray-50">
                <div class="container mx-auto px-4">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 flex items-center gap-3">
                            <span class="w-2 h-10 bg-gradient-to-b from-purple-600 to-pink-600 rounded-full"></span>
                            {{ $category }}
                        </h2>
                        <a href="{{ route('category.show', $articles->first()->category->slug) }}"
                           class="text-purple-600 hover:text-purple-700 font-semibold flex items-center gap-2 group">
                            View All
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($articles->take(4) as $article)
                            <article class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group">
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/400x300' }}"
                                         alt="{{ $article->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="p-4">
                                    <a href="{{ route('article.show', $article->slug) }}">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 hover:text-purple-600 transition">
                                            {{ $article->title }}
                                        </h3>
                                    </a>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>{{ $article->published_at->format('M d') }}</span>
                                        <span>{{ $article->reading_time }} min</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    <!-- Newsletter Subscription -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Subscribe to Our Newsletter</h2>
            <p class="text-xl mb-8 text-blue-100">Get the latest news and updates delivered to your inbox</p>

            <form class="max-w-md mx-auto flex gap-4">
                <input type="email"
                       placeholder="Enter your email"
                       class="flex-1 px-6 py-4 rounded-full text-gray-900 focus:outline-none focus:ring-4 focus:ring-white/50">
                <button type="submit"
                        class="px-8 py-4 bg-white text-blue-600 rounded-full font-bold hover:bg-gray-100 transition shadow-lg">
                    Subscribe
                </button>
            </form>
        </div>
    </section>

@endsection

@section('styles')
    <style>
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .animate-marquee {
            animation: marquee 30s linear infinite;
        }

        .breaking-news-slider:hover .animate-marquee {
            animation-play-state: paused;
        }
    </style>
@endsection
