<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Don't track admin pages or API calls
        if ($request->is('admin*') || $request->is('api*') || $request->is('_debugbar*')) {
            return $next($request);
        }

        try {
            PageVisit::create([
                'page_url' => $request->path(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'visited_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Silently fail to not disrupt user experience
        }

        return $next($request);
    }
}
