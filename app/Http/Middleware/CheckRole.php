<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Vérifie que l'utilisateur connecté possède le rôle requis.
     *
     * Utilisation dans les routes :
     *   ->middleware('role:admin')
     *   ->middleware('role:admin,gestionnaire')
     */
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        $utilisateur = $request->user();

        if (! $utilisateur || ! in_array($utilisateur->role, $roles)) {
            return response()->json([
                'message' => 'Accès refusé. Rôle requis : ' . implode(' ou ', $roles) . '.',
            ], 403);
        }

        return $next($request);
    }
}
