<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store new comment
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $article = Article::findOrFail($articleId);

        $comment = Comment::create([
            'article_id' => $article->id,
            'user_id' => auth()->id(), // null if not logged in
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'status' => 'pending', // Admin approval required
        ]);

        return back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }

    // Like a comment
    public function like($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->increment('likes_count');

        return back()->with('success', 'Comment liked!');
    }
}
