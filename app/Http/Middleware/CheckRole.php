<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            if ($utilisateur) {
                return redirect()->route($this->dashboardRoute($utilisateur->role))
                    ->with('error', 'Accès refusé. Vous n\'avez pas les droits pour accéder à cette page.');
            }

            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        return $next($request);
    }

    private function dashboardRoute(string $role): string
    {
        return match ($role) {
            'admin' => 'admin.dashboard',
            'gestionnaire' => 'admin.dashboard',
            'conducteur' => 'driver.dashboard',
            default => 'home',
        };
    }
}
