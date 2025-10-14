<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'article_id',
        'user_id',
        'parent_id',
        'name',
        'email',
        'comment',
        'status',
        'likes_count',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Article relationship
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // User relationship (optional - jodi logged in user comment kore)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Parent comment relationship
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Child comments (replies)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->where('status', 'approved')
            ->oldest();
    }

    // All replies including nested
    public function allReplies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->where('status', 'approved')
            ->with('allReplies')
            ->oldest();
    }

    // Check if comment is parent
    public function isParent()
    {
        return is_null($this->parent_id);
    }

    // Get commenter name
    public function getCommenterName()
    {
        return $this->user ? $this->user->name : $this->name;
    }

    // Get commenter avatar
    public function getCommenterAvatar()
    {
        $name = $this->getCommenterName();
        return "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=random&size=48";
    }

    // Scope for approved comments only
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Scope for parent comments only
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
}
