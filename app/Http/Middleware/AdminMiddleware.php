<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // If the user is not logged in OR is not an admin, block them
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Access denied. You must be an administrator.');
        }

        return $next($request);
    }
}