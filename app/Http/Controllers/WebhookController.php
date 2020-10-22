<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    public function handleInvoicePaymentSucceeded($payload)
    {
        // Handle The Event
        $order_id = $payload['data']['object']['id'];
        $customer_id = $payload['data']['object']['customer']['id'];
    }
}
