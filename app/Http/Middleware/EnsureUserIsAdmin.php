<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Use Auth facade instead of auth() helper to avoid IDE warnings
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Redirect to regular dashboard (use route NAME, not path)
            return redirect()->route('welcome');
        }
        return $next($request);
    }
}