<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session()->has('appLocale') and array_key_exists(Session()->get('appLocale'), Config('languages'))) {
            App::setLocale(Session()->get('appLocale'));
        } else {
            App::setLocale( Config('app.fallback_locale'));
        }
        return $next($request);
    }
}
