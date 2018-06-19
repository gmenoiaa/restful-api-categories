<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ETagMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if ($request->isMethodCacheable()) {
            $etag = md5($response->getContent());
            $requestEtag = str_replace('"', '', $request->getETags());
            if($requestEtag && $requestEtag[0] == $etag) {
                $response->setNotModified();
            }
            $response->setEtag($etag);
        }
        return $response;
    }
}