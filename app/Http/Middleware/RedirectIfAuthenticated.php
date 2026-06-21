<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }

        return $next($request);
    }

    private function redirectByRole(string $role): \Symfony\Component\HttpFoundation\Response
    {
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'gestionnaire' => redirect()->route('manager.dashboard'),
            'conducteur' => redirect()->route('driver.dashboard'),
            default => redirect()->route('home'),
        };
    }
}
