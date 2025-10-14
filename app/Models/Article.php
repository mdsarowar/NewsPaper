<?php

namespace App\Models;

use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'author',
        'reading_time',
        'view_count',
        'status',
        'published_at',
        'is_featured',
        'is_breaking',
        'breaking_title',
        'allow_comments',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_breaking' => 'boolean',
        'allow_comments' => 'boolean',
        'reading_time' => 'integer',
        'view_count' => 'integer',
    ];

    // Boot method - Auto generation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            // Auto-generate slug
            if (empty($article->slug)) {
                $article->slug = static::generateUniqueSlug($article->title);
            }

            // Auto-calculate reading time
            if (empty($article->reading_time) && !empty($article->content)) {
                $article->reading_time = static::calculateReadingTime($article->content);
            }

            // Set default published_at if publishing
            if ($article->status === 'published' && empty($article->published_at)) {
                $article->published_at = now();
            }
        });

        static::updating(function ($article) {
            // Update slug if title changed
            if ($article->isDirty('title') && empty($article->slug)) {
                $article->slug = static::generateUniqueSlug($article->title, $article->id);
            }

            // Update reading time if content changed
            if ($article->isDirty('content') && !empty($article->content)) {
                $article->reading_time = static::calculateReadingTime($article->content);
            }

            // Set published_at when status changes to published
            if ($article->isDirty('status') && $article->status === 'published' && empty($article->published_at)) {
                $article->published_at = now();
            }
        });
    }

    // Generate unique slug
    public static function generateUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)
            ->when($id, fn($query) => $query->where('id', '!=', $id))
            ->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // Calculate reading time (approx 200 words per minute)
    public static function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $minutes = ceil($wordCount / 200);
        return max(1, $minutes); // Minimum 1 minute
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'article_tag','article_id','tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

// Only approved comments
    public function approvedComments()
    {
        return $this->hasMany(Comment::class)
            ->where('status', 'approved')
            ->whereNull('parent_id') // Only parent comments
            ->with('replies') // Load replies
            ->latest();
    }

// Total approved comments count (including replies)
    public function totalApprovedCommentsCount()
    {
        return $this->comments()
            ->where('status', 'approved')
            ->count();
    }

// Or use accessor for easy access
    public function getTotalCommentsAttribute()
    {
        return $this->comments()
            ->where('status', 'approved')
            ->count();
    }
    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBreaking($query)
    {
        return $query->where('is_breaking', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByAuthor($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopePopular($query, $limit = 10)
    {
        return $query->orderBy('view_count', 'desc')->limit($limit);
    }

    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('published_at', 'desc')->limit($limit);
    }

    // Accessors
    public function getReadingTimeTextAttribute()
    {
        return $this->reading_time . 'min read';
    }

    public function getFormattedViewCountAttribute()
    {
        if ($this->view_count >= 1000000) {
            return round($this->view_count / 1000000, 1) . 'M';
        } elseif ($this->view_count >= 1000) {
            return round($this->view_count / 1000, 1) . 'K';
        }
        return $this->view_count;
    }

    public function getExcerptOrContentAttribute()
    {
        return $this->excerpt ?? Str::limit(strip_tags($this->content), 150);
    }

    public function getFeaturedImageOrImageAttribute()
    {
        return $this->featured_image ?? $this->image;
    }

    // Helper Methods
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    public function markAsBreaking($breakingTitle = null)
    {
        $this->update([
            'is_breaking' => true,
            'breaking_title' => $breakingTitle ?? $this->title,
        ]);
    }

    public function removeBreaking()
    {
        $this->update([
            'is_breaking' => false,
            'breaking_title' => null,
        ]);
    }

    public function markAsFeatured()
    {
        $this->update(['is_featured' => true]);
    }

    public function removeFeatured()
    {
        $this->update(['is_featured' => false]);
    }

    public function publish()
    {
        $this->update([
            'status' => 'published',
            'published_at' => $this->published_at ?? now(),
        ]);
    }

    public function archive()
    {
        $this->update(['status' => 'archived']);
    }

    public function unpublish()
    {
        $this->update(['status' => 'draft']);
    }

    public function isPublished()
    {
        return $this->status === 'published' && $this->published_at && $this->published_at <= now();
    }

    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function isArchived()
    {
        return $this->status === 'archived';
    }
}
