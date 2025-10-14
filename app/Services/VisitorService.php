<?php

namespace App\Services;

use App\Models\Visitor;
use Illuminate\Support\Facades\Http;

class VisitorService
{
    /**
     * Track visitor without any package
     */
    public function track()
    {
        $ip = $this->getIpAddress();
        $userAgent = request()->userAgent();

        // Parse user agent manually
        $deviceInfo = $this->parseUserAgent($userAgent);

        // Get location from IP (optional - using free API)
        $location = $this->getLocationFromIp($ip);

        // Create visitor record
        $visitor = Visitor::create([
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'referer' => request()->header('referer'),
            'url' => request()->fullUrl(),
            'method' => request()->method(),

            // Device info
            'device_type' => $deviceInfo['device_type'],
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform'],

            // Location
            'country' => $location['country'] ?? null,
            'city' => $location['city'] ?? null,
            'region' => $location['region'] ?? null,
            'zip' => $location['zip'] ?? null,
            'lat' => $location['lat'] ?? null,
            'lon' => $location['lon'] ?? null,
            'timezone' => $location['timezone'] ?? null,
            'isp' => $location['isp'] ?? null,

            // Session
            'session_id' => session()->getId(),
            'user_id' => auth()->id(),
            'visited_at' => now(),
        ]);

        return $visitor;
    }

    /**
     * Get real IP address (handles proxy/cloudflare)
     */
    protected function getIpAddress()
    {
        $ip = request()->ip();

        // Check for proxy/cloudflare
        if (request()->header('CF-Connecting-IP')) {
            $ip = request()->header('CF-Connecting-IP');
        } elseif (request()->header('X-Forwarded-For')) {
            $ip = explode(',', request()->header('X-Forwarded-For'))[0];
        } elseif (request()->header('X-Real-IP')) {
            $ip = request()->header('X-Real-IP');
        }

        return $ip;
    }

    /**
     * Parse user agent manually (no package)
     */
    protected function parseUserAgent($userAgent)
    {
        $userAgent = strtolower($userAgent);

        // Detect Device Type
        $deviceType = 'desktop';
        if (preg_match('/mobile|android|iphone|ipod|blackberry|windows phone/i', $userAgent)) {
            $deviceType = 'mobile';
        } elseif (preg_match('/tablet|ipad|playbook|silk/i', $userAgent)) {
            $deviceType = 'tablet';
        }

        // Detect Browser
        $browser = 'Unknown';
        if (strpos($userAgent, 'firefox') !== false) {
            $browser = 'Firefox';
        } elseif (strpos($userAgent, 'chrome') !== false) {
            $browser = 'Chrome';
        } elseif (strpos($userAgent, 'safari') !== false) {
            $browser = 'Safari';
        } elseif (strpos($userAgent, 'opera') !== false || strpos($userAgent, 'opr') !== false) {
            $browser = 'Opera';
        } elseif (strpos($userAgent, 'edge') !== false) {
            $browser = 'Edge';
        } elseif (strpos($userAgent, 'msie') !== false || strpos($userAgent, 'trident') !== false) {
            $browser = 'Internet Explorer';
        }

        // Detect Platform/OS
        $platform = 'Unknown';
        if (strpos($userAgent, 'windows') !== false) {
            $platform = 'Windows';
        } elseif (strpos($userAgent, 'mac') !== false) {
            $platform = 'Mac';
        } elseif (strpos($userAgent, 'linux') !== false) {
            $platform = 'Linux';
        } elseif (strpos($userAgent, 'android') !== false) {
            $platform = 'Android';
        } elseif (strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false) {
            $platform = 'iOS';
        }

        return [
            'device_type' => $deviceType,
            'browser' => $browser,
            'platform' => $platform,
        ];
    }

    /**
     * Get location from IP using free API
     */
    protected function getLocationFromIp($ip)
    {
        // Skip localhost
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return ['country' => 'Local', 'city' => 'Localhost'];
        }

        try {
            // Using free IP API (no key required)
            // Option 1: ip-api.com (free, 45 requests/minute)
            $response = Http::timeout(3)->get("http://ip-api.com/json/{$ip}");

            if ($response->successful()) {
                $data = $response->json();

                if ($data['status'] === 'success') {
                    return [
                        'country' => $data['country'] ?? null,
                        'city' => $data['city'] ?? null,
                        'region' => $data['regionName'] ?? null,
                        'zip' => $data['zip'] ?? null,
                        'lat' => $data['lat'] ?? null,
                        'lon' => $data['lon'] ?? null,
                        'timezone' => $data['timezone'] ?? null,
                        'isp' => $data['isp'] ?? null,
                    ];
                }
            }
        } catch (\Exception $e) {
            // Silent fail - don't break tracking if API fails
            \Log::warning('IP location API failed: ' . $e->getMessage());
        }

        return ['country' => null, 'city' => null];
    }

    /**
     * Get statistics
     */
    public function getStatistics()
    {
        return [
            'total' => Visitor::count(),
            'today' => Visitor::today()->count(),
            'this_week' => Visitor::thisWeek()->count(),
            'this_month' => Visitor::thisMonth()->count(),

            'by_device' => [
                'mobile' => Visitor::where('device_type', 'mobile')->count(),
                'tablet' => Visitor::where('device_type', 'tablet')->count(),
                'desktop' => Visitor::where('device_type', 'desktop')->count(),
            ],

            'top_pages' => Visitor::selectRaw('url, COUNT(*) as visits')
                ->groupBy('url')
                ->orderBy('visits', 'desc')
                ->limit(10)
                ->get(),

            'top_countries' => Visitor::selectRaw('country, COUNT(*) as count')
                ->whereNotNull('country')
                ->groupBy('country')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->get(),

            'top_browsers' => Visitor::selectRaw('browser, COUNT(*) as count')
                ->groupBy('browser')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get(),

            'hourly_today' => Visitor::selectRaw('HOUR(visited_at) as hour, COUNT(*) as count')
                ->whereDate('visited_at', today())
                ->groupBy('hour')
                ->orderBy('hour')
                ->get(),
        ];
    }

    /**
     * Get recent visitors
     */
    public function getRecentVisitors($limit = 20)
    {
        return Visitor::with('user')
            ->latest('visited_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Get unique visitors count
     */
    public function getUniqueVisitors($period = 'today')
    {
        $query = Visitor::select('ip_address');

        switch ($period) {
            case 'today':
                $query->whereDate('visited_at', today());
                break;
            case 'week':
                $query->thisWeek();
                break;
            case 'month':
                $query->thisMonth();
                break;
        }

        return $query->distinct()->count();
    }

}
