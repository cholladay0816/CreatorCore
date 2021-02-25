<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CommissionCanView
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
        if (!$request->commission->canView()) {
            return false;
        }
        return $next($request);
    }
}
