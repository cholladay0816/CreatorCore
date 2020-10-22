<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Payment;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    public function handleInvoicePaymentSucceeded($payload)
    {
        // Handle The Event
        $invoice_id = $payload['data']['object']['id'];
        $customer_id = $payload['data']['object']['customer']['id'];
        $payment = Payment::where('invoice_id', '=', $invoice_id)
            ->where('customer_id','=',$customer_id)
            ->firstOrFail();
        $commission = Commission::findOrFail($payment->commission_id);
        if($commission->price != $payment->value)
            abort(403);
        $user = User::findOrFail($payment->user_id, 'id');
        $commission->pay();
        $payment->status = 'Accepted';
    }
}
