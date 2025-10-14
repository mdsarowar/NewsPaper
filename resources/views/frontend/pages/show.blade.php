@extends('frontend.layout')

@section('title', $article->meta_title ?? $article->title)
@section('description', $article->meta_description ?? $article->excerpt)

@section('content')

    <!-- Article Header -->
    <article class="max-w-4xl mx-auto px-4 py-8">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-600 mb-6">
            <a href="{{ route('front_home') }}" class="hover:text-blue-600">Home</a>
            <span>/</span>
            <a href="{{ route('category.show', $article->category->slug) }}" class="hover:text-blue-600">
                {{ $article->category->name }}
            </a>
            <span>/</span>
            <span class="text-gray-900">{{ Str::limit($article->title, 50) }}</span>
        </nav>

        <!-- Category Badge -->
        <div class="flex items-center gap-3 mb-4">
        <span class="px-4 py-1.5 bg-blue-600 text-white text-sm font-semibold rounded-full">
            {{ $article->category->name }}
        </span>
            @if($article->is_featured)
                <span class="px-4 py-1.5 bg-yellow-500 text-white text-sm font-semibold rounded-full">
            ⭐ Featured
        </span>
            @endif
            @if($article->is_breaking)
                <span class="px-4 py-1.5 bg-red-600 text-white text-sm font-semibold rounded-full animate-pulse">
            🔴 Breaking News
        </span>
            @endif
        </div>

        <!-- Article Title -->
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
            {{ $article->title }}
        </h1>

        <!-- Article Meta -->
        <div class="flex flex-wrap items-center gap-6 mb-8 pb-8 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author ?? 'Admin') }}&background=random&size=48"
                     class="w-12 h-12 rounded-full" alt="Author">
                <div>
                    <p class="font-semibold text-gray-900">{{ $article->author ?? 'Admin' }}</p>
                    <p class="text-sm text-gray-500">Author</p>
                </div>
            </div>

            <div class="flex items-center gap-2 text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>{{ $article->published_at->format('F d, Y') }}</span>
            </div>

            <div class="flex items-center gap-2 text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ $article->reading_time }} min read</span>
            </div>

            <div class="flex items-center gap-2 text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <span>{{ $article->view_count ?? 0 }} views</span>
            </div>
        </div>

        <!-- Share Buttons (Floating) -->
        <div class="fixed left-8 top-1/2 -translate-y-1/2 hidden lg:flex flex-col gap-3 z-30">
            <button onclick="shareOnFacebook()" class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center shadow-lg transition transform hover:scale-110" title="Share on Facebook">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </button>

            <button onclick="shareOnTwitter()" class="w-12 h-12 bg-sky-500 hover:bg-sky-600 text-white rounded-full flex items-center justify-center shadow-lg transition transform hover:scale-110" title="Share on Twitter">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
            </button>

            <button onclick="shareOnWhatsApp()" class="w-12 h-12 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center shadow-lg transition transform hover:scale-110" title="Share on WhatsApp">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
            </button>

            <button onclick="shareOnLinkedIn()" class="w-12 h-12 bg-blue-700 hover:bg-blue-800 text-white rounded-full flex items-center justify-center shadow-lg transition transform hover:scale-110" title="Share on LinkedIn">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
            </button>

            <button onclick="copyLink()" class="w-12 h-12 bg-gray-700 hover:bg-gray-800 text-white rounded-full flex items-center justify-center shadow-lg transition transform hover:scale-110" title="Copy Link">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
            </button>
        </div>

        <!-- Featured Image -->
        @if($article->featured_image || $article->image)
            <div class="mb-8 rounded-2xl overflow-hidden shadow-2xl">
                <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('storage/' . $article->image) }}"
                     alt="{{ $article->title }}"
                     class="w-full h-auto">
            </div>
        @endif

        <!-- Article Content -->
        <div class="prose prose-lg max-w-none mb-12">
            {!! $article->content !!}
        </div>

        <!-- Tags -->
        @if($article->tags && $article->tags->count() > 0)
            <div class="flex flex-wrap gap-2 mb-8 pb-8 border-b border-gray-200">
                <span class="text-gray-600 font-semibold">Tags:</span>
                @foreach($article->tags as $tag)
                    <a href="{{ route('tag.show', $tag->slug) }}"
                       class="px-4 py-1.5 bg-gray-100 hover:bg-blue-100 text-gray-700 hover:text-blue-600 rounded-full text-sm transition">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Share Buttons (Mobile) -->
        <div class="lg:hidden mb-8 pb-8 border-b border-gray-200">
            <p class="text-gray-600 font-semibold mb-4">Share this article:</p>
            <div class="flex flex-wrap gap-3">
                <button onclick="shareOnFacebook()" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Facebook
                </button>
                <button onclick="shareOnTwitter()" class="flex items-center gap-2 px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    Twitter
                </button>
                <button onclick="shareOnWhatsApp()" class="flex items-center gap-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    WhatsApp
                </button>
            </div>
        </div>

    </article>

    <!-- Related Articles -->
    @if($relatedArticles && $relatedArticles->count() > 0)
        <section class="bg-gray-50 py-12">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                    <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                    Related Articles
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                        <article class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition group">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://via.placeholder.com/400x300' }}"
                                     alt="{{ $related->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-5">
                                <span class="text-xs text-blue-600 font-semibold">{{ $related->category->name }}</span>
                                <a href="{{ route('article.show', $related->slug) }}">
                                    <h3 class="text-lg font-bold text-gray-900 mt-2 mb-2 line-clamp-2 hover:text-blue-600 transition">
                                        {{ $related->title }}
                                    </h3>
                                </a>
                                <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                                    {{ $related->excerpt }}
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span>{{ $related->published_at->diffForHumans() }}</span>
                                    <span>{{ $related->reading_time }} min read</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Comments Section -->

    <!-- Include comment section -->
    <!-- Comments Section -->
    @if($article->allow_comments)
        <section class="max-w-4xl mx-auto px-4 py-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                Comments ({{ $article->total_comments ?? 0 }})
            </h2>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Comment Form -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Leave a Comment</h3>
                <form action="{{ route('comments.store', $article->id) }}" method="POST" id="comment-form">
                    @csrf
                    <input type="hidden" name="parent_id" id="parent_id" value="">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <input type="text" name="name" placeholder="Your Name *" required
                               value="{{ old('name', auth()->user()->name ?? '') }}"
                               class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <input type="email" name="email" placeholder="Your Email *" required
                               value="{{ old('email', auth()->user()->email ?? '') }}"
                               class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div id="reply-to-message" class="hidden bg-blue-50 border border-blue-200 rounded-lg px-4 py-2 mb-4 flex items-center justify-between">
                        <span class="text-sm text-blue-700">Replying to <strong id="reply-to-name"></strong></span>
                        <button type="button" onclick="cancelReply()" class="text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <textarea name="comment" rows="4" placeholder="Your Comment *" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 mb-4">{{ old('comment') }}</textarea>

                    @error('comment')
                    <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        Post Comment
                    </button>
                </form>
            </div>

            <!-- Comments List -->
            <div class="space-y-6">
                @forelse($comments as $comment)
                    @include('frontend.includes.partial_comment', ['comment' => $comment, 'level' => 0])
                @empty
                    <div class="bg-gray-50 rounded-xl p-8 text-center">
                        <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                    </div>
                @endforelse
            </div>
        </section>
    @endif

    <script>
        function replyToComment(commentId, commenterName) {
            document.getElementById('parent_id').value = commentId;
            document.getElementById('reply-to-name').textContent = commenterName;
            document.getElementById('reply-to-message').classList.remove('hidden');
            document.querySelector('textarea[name="comment"]').focus();
        }

        function cancelReply() {
            document.getElementById('parent_id').value = '';
            document.getElementById('reply-to-message').classList.add('hidden');
        }
    </script>
{{--    @if($article->allow_comments)--}}
{{--        @include('frontend.includes.comment', [--}}
{{--            'article' => $article,--}}
{{--            'comments' => $comments--}}
{{--        ])--}}
{{--    @endif--}}

@endsection

@section('scripts')
    <script>
        const articleUrl = window.location.href;
        const articleTitle = "{{ $article->title }}";

        function shareOnFacebook() {
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(articleUrl)}`, '_blank', 'width=600,height=400');
        }

        function shareOnTwitter() {
            window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(articleUrl)}&text=${encodeURIComponent(articleTitle)}`, '_blank', 'width=600,height=400');
        }

        function shareOnWhatsApp() {
            window.open(`https://wa.me/?text=${encodeURIComponent(articleTitle + ' ' + articleUrl)}`, '_blank');
        }

        function shareOnLinkedIn() {
            window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(articleUrl)}`, '_blank', 'width=600,height=400');
        }

        function copyLink() {
            navigator.clipboard.writeText(articleUrl).then(() => {
                alert('Link copied to clipboard!');
            });
        }
    </script>
@endsection
