@extends('admin.master')

@section('title', 'Comments Management')

@section('content')

    <div class="container mx-auto px-4 py-8">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Comments Management</h1>
                <p class="text-gray-600 mt-1">Manage and moderate user comments</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Comments -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Total Comments</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Pending</p>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Approved -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Approved</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['approved'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Rejected -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Rejected</p>
                        <p class="text-3xl font-bold text-red-600 mt-2">{{ $stats['rejected'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by name, email, comment, or article..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select
                        name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <!-- Sort -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <select
                        name="sort"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="most_liked" {{ request('sort') == 'most_liked' ? 'selected' : '' }}>Most Liked</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="md:col-span-4 flex gap-3">
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                        Apply Filters
                    </button>
                    @if(request()->hasAny(['search', 'status', 'sort']))
                        <a href="{{ route('comments.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Bulk Actions -->
        <form id="bulk-action-form" method="POST" action="{{ route('comments.bulk-action') }}">
            @csrf
            <input type="hidden" name="action" id="bulk-action-input">

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Table Header with Bulk Actions -->
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gray-50">
                    <div class="flex items-center gap-4">
                        <input
                            type="checkbox"
                            id="select-all"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        >
                        <label for="select-all" class="text-sm font-medium text-gray-700">Select All</label>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600">With Selected:</span>
                        <button
                            type="button"
                            onclick="submitBulkAction('approve')"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition"
                        >
                            ✓ Approve
                        </button>
                        <button
                            type="button"
                            onclick="submitBulkAction('reject')"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition"
                        >
                            ✕ Reject
                        </button>
                        <button
                            type="button"
                            onclick="submitBulkAction('delete')"
                            class="px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg transition"
                        >
                            🗑 Delete
                        </button>
                    </div>
                </div>

                <!-- Comments Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Select
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Commenter
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Comment
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Article
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($comments as $comment)
                            <tr class="hover:bg-gray-50 transition">
                                <!-- Checkbox -->
                                <td class="px-6 py-4">
                                    <input
                                        type="checkbox"
                                        name="comment_ids[]"
                                        value="{{ $comment->id }}"
                                        class="comment-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    >
                                </td>

                                <!-- Commenter Info -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $comment->getCommenterAvatar() }}"
                                             class="w-10 h-10 rounded-full"
                                             alt="{{ $comment->getCommenterName() }}">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $comment->getCommenterName() }}</p>
                                            <p class="text-sm text-gray-500">{{ $comment->email }}</p>
                                            @if($comment->parent_id)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800 mt-1">
                                                    Reply
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Comment Text -->
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-900 line-clamp-2 max-w-md">{{ $comment->comment }}</p>
                                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                            </svg>
                                            {{ $comment->likes_count }} likes
                                        </span>
                                        @if($comment->replies->count() > 0)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                                                </svg>
                                                {{ $comment->replies->count() }} replies
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Article -->
                                <td class="px-6 py-4">
                                    <a href="{{ route('article.show', $comment->article->slug) }}"
                                       target="_blank"
                                       class="text-sm text-blue-600 hover:text-blue-800 hover:underline max-w-xs truncate block">
                                        {{ $comment->article->title }}
                                    </a>
                                </td>

                                <!-- Status Badge -->
                                <td class="px-6 py-4">
                                    @if($comment->status == 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            ⏳ Pending
                                        </span>
                                    @elseif($comment->status == 'approved')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            ✓ Approved
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            ✕ Rejected
                                        </span>
                                    @endif
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>{{ $comment->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-2">
{{--                                        @if($comment->status == 'pending')--}}
                                            <form action="{{ route('comments.approve', $comment->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                        class="text-green-600 hover:text-green-800 font-medium"
                                                        title="Approve">
                                                    ✓
                                                </button>
                                            </form>
                                            <form action="{{ route('comments.reject', $comment->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 font-medium"
                                                        title="Reject">
                                                    ✕
                                                </button>
                                            </form>
{{--                                        @endif--}}

                                        <form action="{{ route('comments.destroy', $comment->id) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-gray-600 hover:text-gray-800 font-medium"
                                                    title="Delete">
                                                🗑
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <p class="text-gray-500 text-lg">No comments found</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($comments->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $comments->links() }}
                    </div>
                @endif
            </div>
        </form>

    </div>

    <script>
        // Select All Checkbox
        document.getElementById('select-all')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.comment-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Bulk Actions
        function submitBulkAction(action) {
            const checkedBoxes = document.querySelectorAll('.comment-checkbox:checked');

            if (checkedBoxes.length === 0) {
                alert('Please select at least one comment');
                return;
            }

            if (action === 'delete') {
                if (!confirm(`Are you sure you want to delete ${checkedBoxes.length} comment(s)?`)) {
                    return;
                }
            }

            document.getElementById('bulk-action-input').value = action;
            document.getElementById('bulk-action-form').submit();
        }
    </script>

@endsection
