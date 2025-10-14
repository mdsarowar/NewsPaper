<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of comments
     */
    public function index(Request $request)
    {
        $query = Comment::with(['article', 'user', 'parent']);

        // Search by commenter name, email, or comment text
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('comment', 'like', "%{$search}%")
                    ->orWhereHas('article', function($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by article
        if ($request->filled('article_id')) {
            $query->where('article_id', $request->article_id);
        }

        // Sort
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->oldest();
                break;
            case 'most_liked':
                $query->orderBy('likes_count', 'desc');
                break;
            default: // latest
                $query->latest();
                break;
        }

        $comments = $query->paginate(20)->withQueryString();

        // Get statistics
        $stats = [
            'total' => Comment::count(),
            'pending' => Comment::where('status', 'pending')->count(),
            'approved' => Comment::where('status', 'approved')->count(),
            'rejected' => Comment::where('status', 'rejected')->count(),
        ];

        return view('admin.comment.index', compact('comments', 'stats'));
    }

    /**
     * Show comment details
     */
    public function show($id)
    {
        $comment = Comment::with(['article', 'user', 'parent', 'replies'])->findOrFail($id);
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Approve comment
     */
    public function approve($id)
    {
//        return $id;
        $comment = Comment::findOrFail($id);
        $comment->update(['status' => 'approved']);

        return back()->with('success', 'Comment approved successfully!');
    }

    /**
     * Reject comment
     */
    public function reject($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['status' => 'rejected']);

        return back()->with('success', 'Comment rejected successfully!');
    }

    /**
     * Bulk action
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,delete',
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:comments,id',
        ]);

        $commentIds = $request->comment_ids;

        switch ($request->action) {
            case 'approve':
                Comment::whereIn('id', $commentIds)->update(['status' => 'approved']);
                $message = count($commentIds) . ' comments approved successfully!';
                break;

            case 'reject':
                Comment::whereIn('id', $commentIds)->update(['status' => 'rejected']);
                $message = count($commentIds) . ' comments rejected successfully!';
                break;

            case 'delete':
                Comment::whereIn('id', $commentIds)->delete();
                $message = count($commentIds) . ' comments deleted successfully!';
                break;
        }

        return back()->with('success', $message);
    }

    /**
     * Delete comment
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
