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

    <!-- Comments Loop -->
    <template x-for="comment in comments" :key="comment.id">
        <div>
            @include('frontend.includes.item', ['level' => 0])
        </div>
    </template>
</div>
