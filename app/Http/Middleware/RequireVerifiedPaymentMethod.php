<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireVerifiedPaymentMethod
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
        if (!$request->user()->hasPaymentMethod()) {
            return redirect(route('profile.show'))->with(
                [
                    'error' => 'You must have a verified payment method.'
                ]
            );
        }

        return $next($request);
    }
}
