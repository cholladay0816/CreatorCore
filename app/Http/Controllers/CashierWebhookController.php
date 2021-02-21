<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Http\Controllers\WebhookController;

class CashierWebhookController extends WebhookController
{
    public function handleInvoicePaymentSucceeded($payload)
    {
        Log::info($payload);
        // $commission->chargeSuccess();
    }
}
