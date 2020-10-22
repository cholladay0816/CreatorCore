<?php

namespace App\Http\Controllers;

use App\Models\Commission;

use Illuminate\Http\Request;
use Laravel\Cashier\Payment;
class PaymentController extends Controller
{
    public function show(Commission $commission)
    {
        return view('payment.pay');
    }
    public function new(Request $request)
    {
        return $request->user()->redirectToBillingPortal(route('dashboard'));
        //return view('payment.new');
        //return auth()->user()->paymentMethods();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'payment_method' => 'required',
        ]);
        auth()->user()->createAsStripeCustomer()->updateDefaultPaymentMethod(request('payment_method'));
    }
    public function update(Request $request)
    {
        return $request->user()->redirectToBillingPortal(route('dashboard'));
    }

    public function pay(Commission $commission, Request $request)
    {
        if(!$commission->isBuyer())
            abort(401);

        $validatedData = $request->validate([
            'payment_method' => 'required',
        ]);
        $paymentMethod = $validatedData['payment_method'];
        if(!$paymentMethod)
        {
            abort(401);
        }
        try {
            $stripeCharge = auth()->user()->charge(100, $paymentMethod);

        } catch (\Exception $e) {
            abort(500);
        }
    }
}
