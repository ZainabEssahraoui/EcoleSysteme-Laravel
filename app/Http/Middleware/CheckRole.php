<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // This line is crucial
use Illuminate\Http\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Make sure the Auth facade is being used correctly
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
