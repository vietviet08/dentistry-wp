<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Priority: 
        // 1. User preference (if authenticated)
        // 2. Session locale
        // 3. Default config locale
        
        $locale = config('app.locale');
        
        if (auth()->check() && auth()->user()->locale) {
            $locale = auth()->user()->locale;
        } elseif (Session::has('locale')) {
            $locale = Session::get('locale');
        }
        
        // Validate locale (only allow vi or en)
        if (!in_array($locale, ['vi', 'en'])) {
            $locale = config('app.locale');
        }
        
        App::setLocale($locale);
        
        return $next($request);
    }
}

