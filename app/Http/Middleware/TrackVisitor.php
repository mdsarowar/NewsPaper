<?php

namespace App\Http\Middleware;

use App\Services\VisitorService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip admin routes and API routes
        if ($request->is('admin/*') || $request->is('api/*')) {
            return $next($request);
        }
        try {
            $visitorService = new VisitorService();
            $visitorService->track();
        } catch (\Exception $e) {
            // Silent fail - don't break site if tracking fails
            \Log::error('Visitor tracking failed: ' . $e->getMessage());
        }

        return $next($request);
    }
}
