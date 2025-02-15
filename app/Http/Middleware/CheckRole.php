<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user has the correct role
        if ( $user->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
