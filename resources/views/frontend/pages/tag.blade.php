@extends('frontend.layout')

@section('title', '#' . $tag->name . ' - Articles')

@section('content')

    <!-- Tag Header -->
    <section class="bg-gradient-to-r from-purple-600 to-pink-600 py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <!-- Breadcrumb -->
                <nav class="flex items-center justify-center gap-2 text-sm text-white/80 mb-6">
                    <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                    <span>/</span>
                    <span>Tags</span>
                    <span>/</span>
                    <span class="text-white">{{ $tag->name }}</span>
                </nav>

                <!-- Tag Icon -->
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>

                <!-- Tag Name -->
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    #{{ $tag->name }}
                </h1>

                <!-- Articles Count -->
                <div class="inline-flex items-center gap-2 px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full text-white font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>{{ $articles->total() }} {{ Str::plural('Article', $articles->total()) }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Bar -->
    <section class="bg-white shadow-md sticky top-16 z-30 py-4">
        <div class="container mx-auto px-4">
            <form method="GET" class="flex items-center justify-between gap-4">
                <!-- Sort Options -->
                <select name="sort" onchange="this.form.submit()" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                </select>

                <!-- View Toggle -->
                <div class="flex items-center gap-2">
                    <button type="button" onclick="switchView('grid')" id="gridViewBtn" class="p-2 bg-purple-100 text-purple-600 rounded-lg hover:bg-purple-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </button>
                    <button type="button" onclick="switchView('list')" id="listViewBtn" class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">

            @if($articles->count() > 0)

                <!-- Grid View -->
                <div id="gridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $article)
                        <article class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 group">
                            <!-- Image -->
                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/400x300' }}"
                                     alt="{{ $article->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                                <!-- Category Badge -->
                                <span class="absolute top-4 left-4 px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-full">
                        {{ $article->category->name }}
                    </span>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Meta -->
                                <div class="flex items-center gap-3 mb-3 text-xs text-gray-500">
                                    <span>{{ $article->published_at->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $article->reading_time }} min read</span>
                                </div>

                                <!-- Title -->
                                <a href="{{ route('article.show', $article->slug) }}">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 hover:text-purple-600 transition">
                                        {{ $article->title }}
                                    </h3>
                                </a>

                                <!-- Excerpt -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ $article->excerpt }}
                                </p>

                                <!-- Author & CTA -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author ?? 'Admin') }}&background=random&size=32"
                                             class="w-8 h-8 rounded-full" alt="Author">
                                        <span class="text-sm font-medium text-gray-700">{{ $article->author ?? 'Admin' }}</span>
                                    </div>
                                    <a href="{{ route('article.show', $article->slug) }}"
                                       class="text-purple-600 hover:text-purple-700 text-sm font-semibold">
                                        Read →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- List View (Hidden by default) -->
                <div id="listView" class="hidden space-y-6">
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
                                    <div class="flex items-center gap-3 mb-3">
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                                {{ $article->category->name }}
                            </span>
                                        <span class="text-sm text-gray-600">{{ $article->published_at->format('M d, Y') }}</span>
                                        <span class="text-sm text-gray-600">{{ $article->reading_time }} min</span>
                                    </div>

                                    <a href="{{ route('article.show', $article->slug) }}">
                                        <h3 class="text-2xl font-bold text-gray-900 mb-3 hover:text-purple-600 transition">
                                            {{ $article->title }}
                                        </h3>
                                    </a>

                                    <p class="text-gray-600 mb-4 line-clamp-2">
                                        {{ $article->excerpt }}
                                    </p>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author ?? 'Admin') }}&background=random&size=32"
                                                 class="w-8 h-8 rounded-full" alt="Author">
                                            <span class="text-sm font-medium text-gray-700">{{ $article->author ?? 'Admin' }}</span>
                                        </div>
                                        <a href="{{ route('article.show', $article->slug) }}"
                                           class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-sm font-semibold transition">
                                            Read Article
                                        </a>
                                    </div>
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
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="flex justify-center mb-6">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Articles Found</h3>
                    <p class="text-gray-600 mb-6">
                        There are no articles tagged with "#{{ $tag->name }}" yet.
                    </p>
                    <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition">
                        Explore All Articles
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Related Tags -->
    @php
        $relatedTags = \App\Models\Tags::where('id', '!=', $tag->id)
            ->withCount(['articles' => function($query) {
                $query->where('status', 'published');
            }])
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->take(12)
            ->get();
    @endphp

    @if($relatedTags->count() > 0)
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Explore Related Tags</h2>

                <div class="flex flex-wrap gap-3">
                    @foreach($relatedTags as $relatedTag)
                        <a href="{{ route('tag.show', $relatedTag->slug) }}"
                           class="px-6 py-3 bg-gray-100 hover:bg-purple-100 text-gray-700 hover:text-purple-600 rounded-full font-medium transition group">
                <span class="flex items-center gap-2">
                    #{{ $relatedTag->name }}
                    <span class="text-xs text-gray-500 group-hover:text-purple-500">
                        ({{ $relatedTag->articles_count }})
                    </span>
                </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection

@section('scripts')
    <script>
        function switchView(view) {
            const gridView = document.getElementById('gridView');
            const listView = document.getElementById('listView');
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');

            if (view === 'grid') {
                gridView.classList.remove('hidden');
                listView.classList.add('hidden');
                gridBtn.classList.remove('bg-gray-100', 'text-gray-600');
                gridBtn.classList.add('bg-purple-100', 'text-purple-600');
                listBtn.classList.remove('bg-purple-100', 'text-purple-600');
                listBtn.classList.add('bg-gray-100', 'text-gray-600');
            } else {
                gridView.classList.add('hidden');
                listView.classList.remove('hidden');
                listBtn.classList.remove('bg-gray-100', 'text-gray-600');
                listBtn.classList.add('bg-purple-100', 'text-purple-600');
                gridBtn.classList.remove('bg-purple-100', 'text-purple-600');
                gridBtn.classList.add('bg-gray-100', 'text-gray-600');
            }
        }
    </script>
@endsection
