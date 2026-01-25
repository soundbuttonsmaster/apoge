<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompressResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only compress HTML responses
        if (method_exists($response, 'header') && 
            $response->headers->get('Content-Type') && 
            strpos($response->headers->get('Content-Type'), 'text/html') !== false) {
            
            // Remove whitespace and compress HTML
            $content = $response->getContent();
            
            // Remove comments (except conditional comments)
            $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
            
            // Remove whitespace between tags
            $content = preg_replace('/>\s+</', '><', $content);
            
            // Remove leading/trailing whitespace
            $content = trim($content);
            
            $response->setContent($content);
        }

        return $response;
    }
}
