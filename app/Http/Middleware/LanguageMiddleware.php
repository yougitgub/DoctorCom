<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Get locale from session, default to 'en' if not set
        $locale = $request->session()->get('locale', config('app.locale', 'en'));
        
        // Ensure locale is valid
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }
        
        // Set the application locale - this is critical for translations
        App::setLocale($locale);
        
        // Also set fallback locale
        App::setFallbackLocale('en');
        
        // Ensure locale is stored in session
        if ($request->session()->get('locale') !== $locale) {
            $request->session()->put('locale', $locale);
        }
        
        // Debug: Log locale setting (remove in production)
        // \Log::info('Language Middleware: Setting locale to ' . $locale);
        
        // Force RTL for Arabic
        if ($locale === 'ar') {
            config(['app.rtl' => true]);
        }

        // Pass request to next middleware
        $response = $next($request);
        
        // Ensure locale persists in response
        $response->headers->set('Content-Language', $locale);
        
        return $response;
    }
}