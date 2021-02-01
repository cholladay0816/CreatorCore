<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PaymentMethod
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
        // TODO: make middleware passable for testing
        if (config('app.env') != 'testing') {
            if ($request->user() && !$request->user()->hasPaymentMethod()) {
                // This user does not have a valid source...
                return redirect(route('source.create'));
            }
        }
        return $next($request);
    }
}
