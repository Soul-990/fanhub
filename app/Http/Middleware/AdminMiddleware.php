<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access the admin area.');
        }

        if (auth()->user()->is_banned) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Your account has been suspended by an administrator.');
        }

        if ((int)auth()->user()->role !== 1) {
            abort(403, 'Unauthorized access: Administrator role required.');
        }

        return $next($request);
    }
}
