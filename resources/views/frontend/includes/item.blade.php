{{--<div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 p-6 {{ $level > 0 ? 'ml-8 md:ml-12' : '' }}">--}}
{{--    <div class="flex items-start gap-4">--}}
{{--        <!-- Avatar -->--}}
{{--        <img--}}
{{--            :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(comment.user ? comment.user.name : comment.name)}&background=random&size=48`"--}}
{{--            :alt="comment.user ? comment.user.name : comment.name"--}}
{{--            class="w-12 h-12 rounded-full flex-shrink-0 ring-2 ring-gray-100"--}}
{{--        >--}}

{{--        <div class="flex-1 min-w-0">--}}
{{--            <!-- Header -->--}}
{{--            <div class="flex items-center justify-between mb-2 flex-wrap gap-2">--}}
{{--                <div>--}}
{{--                    <p class="font-semibold text-gray-900" x-text="comment.user ? comment.user.name : comment.name"></p>--}}
{{--                    <p class="text-sm text-gray-500" x-text="formatDate(comment.created_at)"></p>--}}
{{--                </div>--}}

{{--                <!-- Reply Button -->--}}
{{--                <button--}}
{{--                    @click="replyToComment(comment.id, comment.user ? comment.user.name : comment.name)"--}}
{{--                    class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1 transition group"--}}
{{--                >--}}
{{--                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>--}}
{{--                    </svg>--}}
{{--                    Reply--}}
{{--                </button>--}}
{{--            </div>--}}

{{--            <!-- Comment Text -->--}}
{{--            <p class="text-gray-700 break-words leading-relaxed mb-3" x-text="comment.comment"></p>--}}

{{--            <!-- Actions -->--}}
{{--            <div class="flex items-center gap-6">--}}
{{--                <!-- Like Button -->--}}
{{--                <button--}}
{{--                    @click="likeComment(comment.id)"--}}
{{--                    :disabled="loadingLike[comment.id]"--}}
{{--                    class="text-gray-500 hover:text-blue-600 text-sm flex items-center gap-2 transition disabled:opacity-50 group"--}}
{{--                >--}}
{{--                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>--}}
{{--                    </svg>--}}
{{--                    <span x-text="comment.likes_count" class="font-medium"></span>--}}
{{--                    <span x-show="loadingLike[comment.id]" class="text-xs">(updating...)</span>--}}
{{--                </button>--}}

{{--                <!-- Replies Count (if has replies) -->--}}
{{--                <template x-if="comment.replies && comment.replies.length > 0">--}}
{{--                    <div class="text-sm text-gray-500 flex items-center gap-1">--}}
{{--                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>--}}
{{--                        </svg>--}}
{{--                        <span x-text="comment.replies.length + ' ' + (comment.replies.length === 1 ? 'reply' : 'replies')"></span>--}}
{{--                    </div>--}}
{{--                </template>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<!-- Nested Replies (Maximum 3 levels) -->--}}
{{--<template x-if="comment.replies && comment.replies.length > 0 && {{ $level }} < 3">--}}
{{--    <div class="mt-4 space-y-4">--}}
{{--        <template x-for="reply in comment.replies" :key="reply.id">--}}
{{--            <div x-data="{ comment: reply }">--}}
{{--                @include('frontend.includes.item', ['level' => $level + 1])--}}
{{--            </div>--}}
{{--        </template>--}}
{{--    </div>--}}
{{--</template>--}}


<!-- Single Comment Item (Recursive) -->
<div :class="marginClass" class="mb-4">
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 p-6">
        <div class="flex items-start gap-4">
            <!-- Avatar -->
            <img
                :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(comment.user ? comment.user.name : comment.name)}&background=random&size=48`"
                :alt="comment.user ? comment.user.name : comment.name"
                class="w-12 h-12 rounded-full flex-shrink-0 ring-2 ring-gray-100"
            >

            <div class="flex-1 min-w-0">
                <!-- Header -->
                <div class="flex items-center justify-between mb-2 flex-wrap gap-2">
                    <div>
                        <p class="font-semibold text-gray-900" x-text="comment.user ? comment.user.name : comment.name"></p>
                        <p class="text-sm text-gray-500" x-text="$root.formatDate(comment.created_at)"></p>
                    </div>

                    <!-- Reply Button (only if not at max depth) -->
                    <button
                        x-show="canReply"
                        @click="$root.replyToComment(comment.id, comment.user ? comment.user.name : comment.name)"
                        class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1 transition group"
                    >
                        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                        </svg>
                        Reply
                    </button>
                </div>

                <!-- Comment Text -->
                <p class="text-gray-700 break-words leading-relaxed mb-3" x-text="comment.comment"></p>

                <!-- Actions -->
                <div class="flex items-center gap-6">
                    <!-- Like Button -->
                    <button
                        @click="$root.likeComment(comment.id)"
                        :disabled="$root.loadingLike[comment.id]"
                        class="text-gray-500 hover:text-blue-600 text-sm flex items-center gap-2 transition disabled:opacity-50 group"
                    >
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                        </svg>
                        <span x-text="comment.likes_count" class="font-medium"></span>
                        <span x-show="$root.loadingLike[comment.id]" class="text-xs">(updating...)</span>
                    </button>

                    <!-- Replies Count -->
                    <template x-if="comment.replies && comment.replies.length > 0">
                        <div class="text-sm text-gray-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                            </svg>
                            <span x-text="comment.replies.length + ' ' + (comment.replies.length === 1 ? 'reply' : 'replies')"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Nested Replies (Recursive, Maximum 3 levels) -->
    <template x-if="comment.replies && comment.replies.length > 0 && level < 3">
        <div class="mt-4 space-y-4">
            <template x-for="reply in comment.replies" :key="reply.id">
                <div x-data="commentItem(reply, level + 1)">
                    @include('frontend.includes.item')
                </div>
            </template>
        </div>
    </template>
</div>
