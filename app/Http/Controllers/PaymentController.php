<?php

namespace App\Http\Controllers;

use App\Models\Commission;

use Illuminate\Http\Request;
use Laravel\Cashier\Payment;
class PaymentController extends Controller
{
    public function show(Commission $commission)
    {
        if(!$commission->isBuyer())
        {
            abort(401);
        }
        //A payment method must be set up
        if(!auth()->user()->hasPaymentMethod())
            return auth()->user()->redirectToBillingPortal(url('/payment/'.$commission->id));
        return view('payment.pay', ['title'=>$commission->title, 'commission'=>$commission, 'method'=>auth()->user()->defaultPaymentMethod()]);
    }

    public function pay(Commission $commission, Request $request)
    {
        if(!$commission->isBuyer())
            abort(401);

        if(!auth()->user()->hasPaymentMethod())
            abort(401);

        try
        {
            $stripeCharge = auth()->user()->invoiceFor($commission->title, $commission->truePrice()*100);
            $payment = new \App\Models\Payment();
            $payment->user_id = auth()->user()->id;
            $payment->customer_id = $stripeCharge->customer;
            $payment->invoice_id = $stripeCharge->id;
            $payment->commission_id = $commission->id;
            $payment->value = $commission->price;
            $payment->total = floatval($stripeCharge->total) / 100;
            $payment->save();

            return redirect(route('orders'));
        }
        catch (\Exception $e)
        {
            var_dump($e);
        }
    }
}
