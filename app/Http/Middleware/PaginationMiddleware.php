<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PaginationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has('per_page')) {
            $request->request->add(['per_page' => 10]);
        }

        if (!$request->has('page')) {
            $request->request->add(['page' => 1]);
        }
        return $next($request);
    }
}
