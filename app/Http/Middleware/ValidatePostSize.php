<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidatePostSize
{
    public function handle(Request $request, Closure $next)
    {
        $max = intval(ini_get('post_max_size'));

        if ($max > 0 && $request->server('CONTENT_LENGTH') > $max * 1024 * 1024) {
            abort(413, 'La taille des données soumises dépasse la limite autorisée.');
        }

        return $next($request);
    }
}
