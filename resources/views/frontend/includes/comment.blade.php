{{--<section class="max-w-4xl mx-auto px-4 py-12"--}}
{{--         x-data="commentSystem({{ $article->id }})"--}}
{{--         x-init="init()">--}}

{{--    <!-- Header -->--}}
{{--    <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">--}}
{{--        <span class="w-2 h-8 bg-blue-600 rounded-full"></span>--}}
{{--        Comments (<span x-text="totalComments">{{ $article->total_comments ?? 0 }}</span>)--}}
{{--    </h2>--}}

{{--    <!-- Success/Error Messages -->--}}
{{--    <div x-show="successMessage"--}}
{{--         x-transition--}}
{{--         class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center justify-between">--}}
{{--        <span x-text="successMessage"></span>--}}
{{--        <button @click="successMessage = ''" class="text-green-700 hover:text-green-900">--}}
{{--            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>--}}
{{--            </svg>--}}
{{--        </button>--}}
{{--    </div>--}}

{{--    <div x-show="errorMessage"--}}
{{--         x-transition--}}
{{--         class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center justify-between">--}}
{{--        <span x-text="errorMessage"></span>--}}
{{--        <button @click="errorMessage = ''" class="text-red-700 hover:text-red-900">--}}
{{--            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>--}}
{{--            </svg>--}}
{{--        </button>--}}
{{--    </div>--}}

{{--    <!-- Comment Form -->--}}
{{--    <div class="bg-white rounded-xl shadow-lg p-6 mb-8" x-ref="commentForm">--}}
{{--        <h3 class="text-xl font-bold text-gray-900 mb-4">Leave a Comment</h3>--}}

{{--        <form @submit.prevent="submitComment">--}}
{{--            <!-- Name & Email -->--}}
{{--            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">--}}
{{--                <div>--}}
{{--                    <input--}}
{{--                        type="text"--}}
{{--                        x-model="formData.name"--}}
{{--                        placeholder="Your Name *"--}}
{{--                        required--}}
{{--                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"--}}
{{--                        :disabled="isSubmitting"--}}
{{--                    >--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <input--}}
{{--                        type="email"--}}
{{--                        x-model="formData.email"--}}
{{--                        placeholder="Your Email *"--}}
{{--                        required--}}
{{--                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"--}}
{{--                        :disabled="isSubmitting"--}}
{{--                    >--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Reply To Message -->--}}
{{--            <div x-show="replyingTo"--}}
{{--                 x-transition--}}
{{--                 class="bg-blue-50 border border-blue-200 rounded-lg px-4 py-3 mb-4 flex items-center justify-between">--}}
{{--                <div class="flex items-center gap-2">--}}
{{--                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>--}}
{{--                    </svg>--}}
{{--                    <span class="text-sm text-blue-700">--}}
{{--                    Replying to <strong x-text="replyingTo"></strong>--}}
{{--                </span>--}}
{{--                </div>--}}
{{--                <button--}}
{{--                    type="button"--}}
{{--                    @click="cancelReply()"--}}
{{--                    class="text-blue-600 hover:text-blue-800 transition">--}}
{{--                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}

{{--            <!-- Comment Textarea -->--}}
{{--            <div class="mb-4">--}}
{{--            <textarea--}}
{{--                name="comment"--}}
{{--                x-model="formData.comment"--}}
{{--                rows="4"--}}
{{--                placeholder="Your Comment *"--}}
{{--                required--}}
{{--                maxlength="1000"--}}
{{--                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"--}}
{{--                :disabled="isSubmitting"--}}
{{--            ></textarea>--}}
{{--                <div class="flex items-center justify-between mt-2 text-sm text-gray-500">--}}
{{--                    <span>Maximum 1000 characters</span>--}}
{{--                    <span x-text="formData.comment.length + '/1000'"></span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Submit Button -->--}}
{{--            <button--}}
{{--                type="submit"--}}
{{--                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"--}}
{{--                :disabled="isSubmitting"--}}
{{--            >--}}
{{--                <!-- Loading Spinner -->--}}
{{--                <svg x-show="isSubmitting" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">--}}
{{--                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>--}}
{{--                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>--}}
{{--                </svg>--}}

{{--                <span x-text="isSubmitting ? 'Submitting...' : 'Post Comment'"></span>--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--    @include('frontend.includes.form')--}}

{{--    <!-- Comments List -->--}}
{{--    <div class="space-y-6">--}}
{{--        <!-- No Comments State -->--}}
{{--        <template x-if="comments.length === 0">--}}
{{--            <div class="bg-gray-50 rounded-xl p-12 text-center">--}}
{{--                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>--}}
{{--                </svg>--}}
{{--                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Comments Yet</h3>--}}
{{--                <p class="text-gray-600">Be the first to share your thoughts!</p>--}}
{{--            </div>--}}
{{--        </template>--}}

{{--        <!-- Comments Loop -->--}}
{{--        <template x-for="comment in comments" :key="comment.id">--}}
{{--            <div>--}}
{{--                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 p-6 {{ $level > 0 ? 'ml-8 md:ml-12' : '' }}">--}}
{{--                    <div class="flex items-start gap-4">--}}
{{--                        <!-- Avatar -->--}}
{{--                        <img--}}
{{--                            :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(comment.user ? comment.user.name : comment.name)}&background=random&size=48`"--}}
{{--                            :alt="comment.user ? comment.user.name : comment.name"--}}
{{--                            class="w-12 h-12 rounded-full flex-shrink-0 ring-2 ring-gray-100"--}}
{{--                        >--}}

{{--                        <div class="flex-1 min-w-0">--}}
{{--                            <!-- Header -->--}}
{{--                            <div class="flex items-center justify-between mb-2 flex-wrap gap-2">--}}
{{--                                <div>--}}
{{--                                    <p class="font-semibold text-gray-900" x-text="comment.user ? comment.user.name : comment.name"></p>--}}
{{--                                    <p class="text-sm text-gray-500" x-text="formatDate(comment.created_at)"></p>--}}
{{--                                </div>--}}

{{--                                <!-- Reply Button -->--}}
{{--                                <button--}}
{{--                                    @click="replyToComment(comment.id, comment.user ? comment.user.name : comment.name)"--}}
{{--                                    class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1 transition group"--}}
{{--                                >--}}
{{--                                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>--}}
{{--                                    </svg>--}}
{{--                                    Reply--}}
{{--                                </button>--}}
{{--                            </div>--}}

{{--                            <!-- Comment Text -->--}}
{{--                            <p class="text-gray-700 break-words leading-relaxed mb-3" x-text="comment.comment"></p>--}}

{{--                            <!-- Actions -->--}}
{{--                            <div class="flex items-center gap-6">--}}
{{--                                <!-- Like Button -->--}}
{{--                                <button--}}
{{--                                    @click="likeComment(comment.id)"--}}
{{--                                    :disabled="loadingLike[comment.id]"--}}
{{--                                    class="text-gray-500 hover:text-blue-600 text-sm flex items-center gap-2 transition disabled:opacity-50 group"--}}
{{--                                >--}}
{{--                                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>--}}
{{--                                    </svg>--}}
{{--                                    <span x-text="comment.likes_count" class="font-medium"></span>--}}
{{--                                    <span x-show="loadingLike[comment.id]" class="text-xs">(updating...)</span>--}}
{{--                                </button>--}}

{{--                                <!-- Replies Count (if has replies) -->--}}
{{--                                <template x-if="comment.replies && comment.replies.length > 0">--}}
{{--                                    <div class="text-sm text-gray-500 flex items-center gap-1">--}}
{{--                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>--}}
{{--                                        </svg>--}}
{{--                                        <span x-text="comment.replies.length + ' ' + (comment.replies.length === 1 ? 'reply' : 'replies')"></span>--}}
{{--                                    </div>--}}
{{--                                </template>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Nested Replies (Maximum 3 levels) -->--}}
{{--                <template x-if="comment.replies && comment.replies.length > 0 && {{ $level }} < 3">--}}
{{--                    <div class="mt-4 space-y-4">--}}
{{--                        <template x-for="reply in comment.replies" :key="reply.id">--}}
{{--                            <div x-data="{ comment: reply }">--}}
{{--                                                @include('frontend.includes.item', ['level' => $level + 1])--}}
{{--                            </div>--}}
{{--                        </template>--}}
{{--                    </div>--}}
{{--                </template>--}}
{{--                @include('frontend.includes.item', ['level' => 0])--}}
{{--            </div>--}}
{{--        </template>--}}
{{--    </div>--}}
{{--    @include('frontend.includes.list')--}}

{{--</section>--}}

{{--<script>--}}
{{--    function commentSystem(articleId) {--}}
{{--        return {--}}
{{--            articleId: articleId,--}}
{{--            comments: @json($comments),--}}
{{--            totalComments: {{ $article->total_comments ?? 0 }},--}}

{{--            // Form data--}}
{{--            formData: {--}}
{{--                name: '{{ auth()->user()->name ?? '' }}',--}}
{{--                email: '{{ auth()->user()->email ?? '' }}',--}}
{{--                comment: '',--}}
{{--                parent_id: null--}}
{{--            },--}}

{{--            // UI states--}}
{{--            isSubmitting: false,--}}
{{--            successMessage: '',--}}
{{--            errorMessage: '',--}}
{{--            replyingTo: null,--}}
{{--            loadingLike: {},--}}

{{--            // Initialize--}}
{{--            init() {--}}
{{--                console.log('Comment system initialized');--}}
{{--            },--}}

{{--            // Submit comment--}}
{{--            async submitComment() {--}}
{{--                if (!this.formData.comment.trim()) {--}}
{{--                    this.errorMessage = 'Please enter a comment';--}}
{{--                    return;--}}
{{--                }--}}

{{--                this.isSubmitting = true;--}}
{{--                this.errorMessage = '';--}}

{{--                try {--}}
{{--                    const response = await fetch(`/article/${this.articleId}/comment`, {--}}
{{--                        method: 'POST',--}}
{{--                        headers: {--}}
{{--                            'Content-Type': 'application/json',--}}
{{--                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,--}}
{{--                            'Accept': 'application/json'--}}
{{--                        },--}}
{{--                        body: JSON.stringify(this.formData)--}}
{{--                    });--}}

{{--                    const data = await response.json();--}}

{{--                    if (response.ok) {--}}
{{--                        this.successMessage = 'Your comment has been submitted and is awaiting approval.';--}}

{{--                        // Reset form--}}
{{--                        this.formData.comment = '';--}}
{{--                        this.formData.parent_id = null;--}}
{{--                        this.replyingTo = null;--}}

{{--                        // Scroll to top of comments--}}
{{--                        this.$el.scrollIntoView({ behavior: 'smooth', block: 'start' });--}}
{{--                    } else {--}}
{{--                        this.errorMessage = data.message || 'Failed to submit comment. Please try again.';--}}
{{--                    }--}}
{{--                } catch (error) {--}}
{{--                    console.error('Error:', error);--}}
{{--                    this.errorMessage = 'An error occurred. Please try again.';--}}
{{--                } finally {--}}
{{--                    this.isSubmitting = false;--}}
{{--                }--}}
{{--            },--}}

{{--            // Reply to comment--}}
{{--            replyToComment(commentId, commenterName) {--}}
{{--                this.formData.parent_id = commentId;--}}
{{--                this.replyingTo = commenterName;--}}

{{--                // Scroll to form--}}
{{--                document.querySelector('[x-ref="commentForm"]').scrollIntoView({--}}
{{--                    behavior: 'smooth',--}}
{{--                    block: 'center'--}}
{{--                });--}}

{{--                // Focus textarea--}}
{{--                setTimeout(() => {--}}
{{--                    document.querySelector('textarea[name="comment"]').focus();--}}
{{--                }, 500);--}}
{{--            },--}}

{{--            // Cancel reply--}}
{{--            cancelReply() {--}}
{{--                this.formData.parent_id = null;--}}
{{--                this.replyingTo = null;--}}
{{--            },--}}

{{--            // Like comment--}}
{{--            async likeComment(commentId) {--}}
{{--                if (this.loadingLike[commentId]) return;--}}

{{--                this.loadingLike[commentId] = true;--}}

{{--                try {--}}
{{--                    const response = await fetch(`/comment/${commentId}/like`, {--}}
{{--                        method: 'POST',--}}
{{--                        headers: {--}}
{{--                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,--}}
{{--                            'Accept': 'application/json'--}}
{{--                        }--}}
{{--                    });--}}

{{--                    if (response.ok) {--}}
{{--                        // Update like count in nested structure--}}
{{--                        this.updateLikeCount(this.comments, commentId);--}}
{{--                    }--}}
{{--                } catch (error) {--}}
{{--                    console.error('Error liking comment:', error);--}}
{{--                } finally {--}}
{{--                    this.loadingLike[commentId] = false;--}}
{{--                }--}}
{{--            },--}}

{{--            // Update like count recursively--}}
{{--            updateLikeCount(comments, commentId) {--}}
{{--                for (let comment of comments) {--}}
{{--                    if (comment.id === commentId) {--}}
{{--                        comment.likes_count++;--}}
{{--                        return true;--}}
{{--                    }--}}
{{--                    if (comment.replies && comment.replies.length > 0) {--}}
{{--                        if (this.updateLikeCount(comment.replies, commentId)) {--}}
{{--                            return true;--}}
{{--                        }--}}
{{--                    }--}}
{{--                }--}}
{{--                return false;--}}
{{--            },--}}

{{--            // Format date--}}
{{--            formatDate(dateString) {--}}
{{--                const date = new Date(dateString);--}}
{{--                const now = new Date();--}}
{{--                const diffInSeconds = Math.floor((now - date) / 1000);--}}

{{--                if (diffInSeconds < 60) return 'Just now';--}}
{{--                if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)} minutes ago`;--}}
{{--                if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)} hours ago`;--}}
{{--                if (diffInSeconds < 604800) return `${Math.floor(diffInSeconds / 86400)} days ago`;--}}

{{--                return date.toLocaleDateString('en-US', {--}}
{{--                    year: 'numeric',--}}
{{--                    month: 'short',--}}
{{--                    day: 'numeric'--}}
{{--                });--}}
{{--            }--}}
{{--        }--}}
{{--    }--}}
{{--</script>--}}

<section class="max-w-4xl mx-auto px-4 py-12"
         x-data="commentSystem({{ $article->id }})"
         x-init="init()">

    <!-- Header -->
    <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
        <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
        Comments (<span x-text="totalComments">{{ $article->total_comments ?? 0 }}</span>)
    </h2>

    <!-- Success/Error Messages -->
    <div x-show="successMessage"
         x-transition
         class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
        <span x-text="successMessage"></span>
        <button @click="successMessage = ''" class="text-green-700 hover:text-green-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <div x-show="errorMessage"
         x-transition
         class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
        <span x-text="errorMessage"></span>
        <button @click="errorMessage = ''" class="text-red-700 hover:text-red-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Comment Form -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8" x-ref="commentForm">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Leave a Comment</h3>

        <form @submit.prevent="submitComment">
            <!-- Name & Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <input
                        type="text"
                        x-model="formData.name"
                        placeholder="Your Name *"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        :disabled="isSubmitting"
                    >
                </div>
                <div>
                    <input
                        type="email"
                        x-model="formData.email"
                        placeholder="Your Email *"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        :disabled="isSubmitting"
                    >
                </div>
            </div>

            <!-- Reply To Message -->
            <div x-show="replyingTo"
                 x-transition
                 class="bg-blue-50 border border-blue-200 rounded-lg px-4 py-3 mb-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                    </svg>
                    <span class="text-sm text-blue-700">
                        Replying to <strong x-text="replyingTo"></strong>
                    </span>
                </div>
                <button
                    type="button"
                    @click="cancelReply()"
                    class="text-blue-600 hover:text-blue-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Comment Textarea -->
            <div class="mb-4">
                <textarea
                    name="comment"
                    x-model="formData.comment"
                    rows="4"
                    placeholder="Your Comment *"
                    required
                    maxlength="1000"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                    :disabled="isSubmitting"
                ></textarea>
                <div class="flex items-center justify-between mt-2 text-sm text-gray-500">
                    <span>Maximum 1000 characters</span>
                    <span x-text="formData.comment.length + '/1000'"></span>
                </div>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
                :disabled="isSubmitting"
            >
                <!-- Loading Spinner -->
                <svg x-show="isSubmitting" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>

                <span x-text="isSubmitting ? 'Submitting...' : 'Post Comment'"></span>
            </button>
        </form>
    </div>

    <!-- Comments List -->
    <div class="space-y-6">
        <!-- No Comments State -->
        <template x-if="comments.length === 0">
            <div class="bg-gray-50 rounded-xl p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Comments Yet</h3>
                <p class="text-gray-600">Be the first to share your thoughts!</p>
            </div>
        </template>

        <!-- Comments Loop with Recursive Replies -->
        <template x-for="comment in comments" :key="comment.id">
            <div x-data="{ renderComment: (comment, level = 0) => ({ comment, level }) }"
                 x-init="$el.__commentData = renderComment(comment, 0)">
                <!-- <CHANGE> Added recursive comment rendering component -->
                <div x-data="commentItem($el.__commentData.comment, $el.__commentData.level)">
                    @include('frontend.includes.item')
                </div>
            </div>
        </template>
    </div>

</section>

<script>
    // <CHANGE> Separated comment item logic for better organization
    function commentItem(comment, level) {
        return {
            comment: comment,
            level: level,

            get marginClass() {
                return this.level > 0 ? (this.level === 1 ? 'ml-8 md:ml-12' : 'ml-4 md:ml-8') : '';
            },

            get canReply() {
                return this.level < 3; // Maximum 3 levels
            }
        }
    }

    function commentSystem(articleId) {
        return {
            articleId: articleId,
            comments: @json($comments),
            totalComments: {{ $article->total_comments ?? 0 }},

            // Form data
            formData: {
                name: '{{ auth()->user()->name ?? '' }}',
                email: '{{ auth()->user()->email ?? '' }}',
                comment: '',
                parent_id: null
            },

            // UI states
            isSubmitting: false,
            successMessage: '',
            errorMessage: '',
            replyingTo: null,
            loadingLike: {},

            // Initialize
            init() {
                console.log('Comment system initialized with', this.comments.length, 'comments');
            },

            // Submit comment
            async submitComment() {
                if (!this.formData.comment.trim()) {
                    this.errorMessage = 'Please enter a comment';
                    return;
                }

                this.isSubmitting = true;
                this.errorMessage = '';

                try {
                    const response = await fetch(`/article/${this.articleId}/comment`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.formData)
                    });

                    const data = await response.json();

                    if (response.ok) {
                        this.successMessage = 'Your comment has been submitted and is awaiting approval.';

                        // Reset form
                        this.formData.comment = '';
                        this.formData.parent_id = null;
                        this.replyingTo = null;

                        // Scroll to top of comments
                        this.$el.scrollIntoView({ behavior: 'smooth', block: 'start' });

                        // Auto-hide success message after 5 seconds
                        setTimeout(() => {
                            this.successMessage = '';
                        }, 5000);
                    } else {
                        this.errorMessage = data.message || 'Failed to submit comment. Please try again.';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    this.errorMessage = 'An error occurred. Please try again.';
                } finally {
                    this.isSubmitting = false;
                }
            },

            // Reply to comment
            replyToComment(commentId, commenterName) {
                this.formData.parent_id = commentId;
                this.replyingTo = commenterName;

                // Scroll to form
                const formElement = document.querySelector('[x-ref="commentForm"]');
                if (formElement) {
                    formElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    // Focus textarea
                    setTimeout(() => {
                        const textarea = document.querySelector('textarea[name="comment"]');
                        if (textarea) {
                            textarea.focus();
                        }
                    }, 500);
                }
            },

            // Cancel reply
            cancelReply() {
                this.formData.parent_id = null;
                this.replyingTo = null;
            },

            // Like comment
            async likeComment(commentId) {
                if (this.loadingLike[commentId]) return;

                this.loadingLike[commentId] = true;

                try {
                    const response = await fetch(`/comment/${commentId}/like`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        // Update like count in nested structure
                        this.updateLikeCount(this.comments, commentId);
                    }
                } catch (error) {
                    console.error('Error liking comment:', error);
                } finally {
                    this.loadingLike[commentId] = false;
                }
            },

            // Update like count recursively
            updateLikeCount(comments, commentId) {
                for (let comment of comments) {
                    if (comment.id === commentId) {
                        comment.likes_count++;
                        return true;
                    }
                    if (comment.replies && comment.replies.length > 0) {
                        if (this.updateLikeCount(comment.replies, commentId)) {
                            return true;
                        }
                    }
                }
                return false;
            },

            // Format date
            formatDate(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const diffInSeconds = Math.floor((now - date) / 1000);

                if (diffInSeconds < 60) return 'Just now';
                if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)} minutes ago`;
                if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)} hours ago`;
                if (diffInSeconds < 604800) return `${Math.floor(diffInSeconds / 86400)} days ago`;

                return date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            }
        }
    }
</script>

