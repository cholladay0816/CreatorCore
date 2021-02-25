<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AttachmentCanEdit
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
        if (!$request->attachment->canEdit()) {
            return false;
        }
        return $next($request);
    }
}
