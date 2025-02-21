<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogHttpRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::channel('http')->info('HTTP Request', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'body' => $request->all(),
        ]);

        return $next($request);
    }
}
