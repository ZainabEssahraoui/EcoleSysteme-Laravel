<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login')->with('error', 'Vous devez être connecté.');
        }
        if ($user && $user->role === $role) {
            return $next($request);
        }

        // Redirection en fonction du rôle de l'utilisateur
        if ($user->role === 'prof') {
            return redirect()->route('prof.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }

        // Si l'utilisateur n'a pas de rôle valide, redirigez-le vers une page par défaut
        return redirect('/');
    }
}