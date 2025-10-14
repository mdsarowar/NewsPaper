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
