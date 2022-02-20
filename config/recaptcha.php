<?php

return [
    'public'    => env('GOOGLE_RECAPTCHA_SITE_KEY'),
    'secret'    => env('GOOGLE_RECAPTCHA_SECRET_KEY'),
    'threshold' => env('GOOGLE_RECAPTCHA_THRESHOLD', 0.75)
];
