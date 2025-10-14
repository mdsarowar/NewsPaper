<div x-data="{ open: false }">
    <div class="bg-white rounded-xl shadow-md p-6 {{ $level > 1 ? 'ml-10 md:ml-16': ( $level > 0 ?'ml-6 md:ml-8':'' )}}">
        <div class="flex items-start gap-4">
            <img src="{{ $comment->getCommenterAvatar() }}"
                 class="w-12 h-12 rounded-full flex-shrink-0" alt="{{ $comment->getCommenterName() }}">

            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between mb-2 flex-wrap gap-2">
                    <div>
                        {{--<p>{{$comment}}</p>--}}
                        {{--                    <p class="font-semibold text-gray-900">{{ $comment->getCommenterName() }}--}}
                        {{--                        <span class="text-sm text-blue-400">reply to </span>{{$comment->parent->getCommenterName()}} </p>--}}
                        <p class="font-semibold text-gray-900">
                            {{ $comment->getCommenterName() }}

                            @if($comment->parent_id && $comment->parent)
                                <span class="text-sm text-blue-400">reply to</span>
                                {{ $comment->parent->name }}
                            @endif
                        </p>
                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>

                    <button onclick="replyToComment({{ $comment->id }}, '{{ $comment->getCommenterName() }}')"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                        </svg>
                        Reply
                    </button>
                </div>

                <p class="text-gray-700 break-words">{{ $comment->comment }}</p>

                <!-- Like Button -->
                <div class="mt-3 flex items-center gap-4">
                    <form action="{{ route('comments.like', $comment->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-blue-600 text-sm flex items-center gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                            </svg>
                            <span>{{ $comment->likes_count }}</span> <span>  </span>

                        </button>
                    </form>
                    <button @click="open = ! open">{{  $comment->replies->count()> 0 ? 'replys' :''}}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Nested Replies -->
    {{--<p>{{$comment->replies->count()}}</p>--}}
    <div x-show="open">
        @if($comment->replies->count() > 0 )
            <div class="mt-4 space-y-4">
                @foreach($comment->replies as $reply)
                    @include('frontend.includes.partial_comment', ['comment' => $reply, 'level' => $level + 1])
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    function reply(){

    }
</script>
