<?php

namespace App\Http\Middleware;

use Closure;

class AddBaseHref
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->isSuccessful() && $response->headers->contains('Content-Type', 'text/html')) {
            $content = $response->getContent();
            $baseTag = '<base href="' . url('/') . '/">';
            $content = preg_replace('/(<head[^>]*>)/i', '$1' . $baseTag, $content);
            $response->setContent($content);
        }

        return $response;
    }
}
