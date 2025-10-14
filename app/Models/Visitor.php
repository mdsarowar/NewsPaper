<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'referer',
        'url',
        'method',
        'device_type',
        'browser',
        'platform',
        'country',
        'city',
        'page_title',
        'time_spent',
        'session_id',
        'user_id',
        'visited_at',
        'region',
        'zip',
        'lat',
        'lon',
        'timezone',
        'isp',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    // User relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeToday($query)
    {
        return $query->whereDate('visited_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('visited_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('visited_at', now()->month)
            ->whereYear('visited_at', now()->year);
    }

    public function scopeMobile($query)
    {
        return $query->where('device_type', 'mobile');
    }

    public function scopeDesktop($query)
    {
        return $query->where('device_type', 'desktop');
    }
}
