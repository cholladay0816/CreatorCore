<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Http\Controllers\WebhookController;
use Stripe\StripeClient;

class CashierWebhookController extends WebhookController
{
    public function handleInvoicePaymentSucceeded($payload)
    {
        $invoice_id = $payload['data']['object']['id'];
        try {
            Commission::where('invoice_id', $invoice_id)->firstOrFail()
                ->chargeSuccess();
        } catch (\Exception $e) {
            Commission::where('invoice_id', $invoice_id)->firstOrFail()
                ->chargeFail();
        }
    }
}
