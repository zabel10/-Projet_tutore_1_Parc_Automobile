<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string $prefix)
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        $roleMap = [
            'admin' => 'admin',
            'manager' => 'gestionnaire',
            'driver' => 'conducteur',
        ];

        $requiredRole = $roleMap[$prefix] ?? null;

        if ($requiredRole && $user->role !== $requiredRole) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Accès refusé. Vous n\'avez pas les droits pour accéder à cette ressource.',
                ], 403);
            }
            return redirect()->route($this->dashboardRoute($user->role))
                ->with('error', 'Accès refusé. Vous n\'avez pas l\'autorisation.');
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
