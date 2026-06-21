<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertEmptyStringsToNull
{
    public function handle(Request $request, Closure $next)
    {
        $request->merge($request->all());

        return $next($request);
    }
}
