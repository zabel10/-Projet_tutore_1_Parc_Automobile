<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrimStrings
{
    protected $except = [
        'password',
        'password_confirmation',
        'mot_de_passe',
        'mot_de_passe_confirmation',
    ];

    public function handle(Request $request, Closure $next)
    {
        $request->merge($request->except($this->except));

        return $next($request);
    }
}
