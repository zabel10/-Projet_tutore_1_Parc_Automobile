<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyCsrfToken
{
    protected array $except = [];

    public function handle(Request $request, Closure $next)
    {
        if (
            in_array(strtolower($request->method()), ['get', 'head', 'options']) ||
            $this->inExceptArray($request) ||
            $this->tokensMatch($request)
        ) {
            return $next($request);
        }

        throw new \Illuminate\Session\TokenMismatchException(
            'Le jeton CSRF de votre session a expiré ou est invalide. Veuillez réessayer.'
        );
    }

    protected function tokensMatch(Request $request): bool
    {
        $token = $request->input('_token');

        if (! is_string($token)) {
            $token = (string) $request->string('_token');
        }

        return is_string($token) && hash_equals(
            $request->session()->token(),
            $token
        );
    }

    protected function inExceptArray(Request $request): bool
    {
        foreach ($this->except as $except) {
            if ($except !== '/' && str_starts_with($except, '/')) {
                $except = substr($except, 1);
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }

    protected function addCookieToResponse(
        \Illuminate\Contracts\Foundation\Application $app,
        \Symfony\Component\HttpFoundation\Response $response
    ): void {
        $config = $app->make('config')->get('session');

        $response->headers->setCookie(
            new \Symfony\Component\HttpFoundation\Cookie(
                'XSRF-TOKEN',
                $response->headers->get('X-XSRF-TOKEN'),
                time() + 120 * 60,
                $config['path'],
                $config['domain'],
                $config['secure'],
                false,
                false,
                $config['same_site'] ?? 'lax'
            )
        );
    }
}
