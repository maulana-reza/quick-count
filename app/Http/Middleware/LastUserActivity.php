<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            Log::info('[ACTIVITY] LastUserActivity triggered for user: ' . Auth::id());
            $expiresAt = now()->addMinutes(5); // 5 menit dianggap aktif
            Cache::put('user-is-online-' . Auth::id(), true, $expiresAt);
            // update last seen
            Auth::user()->update(['last_seen_at' => now()]);
        }

        return $next($request);
    }
}
