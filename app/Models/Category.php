<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'image',
        'status',
        'display_order',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'display_order' => 'integer',
        'parent_id' => 'integer',
    ];

    /**
     * Boot method - Auto generate slug
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug when creating
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        // Auto-update slug when updating name
        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Relationship: Parent Category
     * A category can have one parent
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Relationship: Sub Categories (Children)
     * A category can have many children
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->orderBy('display_order', 'asc');
    }

    /**
     * Relationship: Articles
     * A category has many articles
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Scope: Only Active Categories
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope: Only Main Categories (no parent)
     */
    public function scopeMainCategories($query)
    {
        return $query->whereNull('parent_id')
            ->orderBy('display_order', 'asc');
    }

    /**
     * Scope: With Sub Categories
     */
    public function scopeWithChildren($query)
    {
        return $query->with('children');
    }

    /**
     * Accessor: Get full image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-category.jpg'); // Default image
    }

    /**
     * Check if category has children
     */
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    /**
     * Check if category is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get breadcrumb trail
     * Example: Technology > AI > Machine Learning
     */
    public function getBreadcrumb()
    {
        $breadcrumb = collect([$this]);

        $parent = $this->parent;
        while ($parent) {
            $breadcrumb->prepend($parent);
            $parent = $parent->parent;
        }

        return $breadcrumb;
    }
}
