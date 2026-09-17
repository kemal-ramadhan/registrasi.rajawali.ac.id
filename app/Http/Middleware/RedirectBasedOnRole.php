<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role === 'Admin') {
            return redirect('/dashboard');
        }

        if ($user->role === 'Customer') {
            return redirect('/');
        }

        if ($user->role === 'BK') {
            return redirect('/bk');
        }

        return $next($request);
    }
}
