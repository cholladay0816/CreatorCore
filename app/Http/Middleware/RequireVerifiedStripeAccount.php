<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireVerifiedStripeAccount
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
        if (!$request->user()->canAcceptPayments()) {
            return redirect(route('profile.show'))->with(['error' => '
            Your Stripe Account must be able to make payouts.
            Verify your ID or try again later.']);
        }

        return $next($request);
    }
}
