<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DisableBrowserCache
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!method_exists($response, 'headers')) {
            return $response;
        }

        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0, private');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        $response->headers->set('Surrogate-Control', 'no-store');
        $response->headers->remove('ETag');

        return $response;
    }
}
