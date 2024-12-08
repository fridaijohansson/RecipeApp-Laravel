<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\IsAdmin as Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Allow access
        }

        // abort if not admin
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
