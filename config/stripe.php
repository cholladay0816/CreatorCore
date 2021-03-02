<?php

return [
        'secret' => env('STRIPE_SECRET', ''),
        'public' => env('STRIPE_KEY', ''),
        'currency' => env('STRIPE_CURRENCY', 'usd'),
    ];
