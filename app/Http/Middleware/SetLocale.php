<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    // app/Http/Middleware/SetLocale.php
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->language) {
            App::setLocale(Auth::user()->language);
        }

        return $next($request);
    }
}
