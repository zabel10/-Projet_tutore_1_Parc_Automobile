<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        $utilisateur = $request->user();

        if (! $utilisateur || ! in_array($utilisateur->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Accès refusé. Rôle requis : ' . implode(' ou ', $roles) . '.',
                ], 403);
            }
            return redirect()->route('login')->with('error', 'Accès refusé. Veuillez vous connecter avec les bons droits.');
        }

        return $next($request);
    }
}