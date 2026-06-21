<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrustProxies
{
    protected $proxies;

    protected $headers = \Illuminate\Http\Request::HEADER_X_FORWARDED_ALL;

    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
