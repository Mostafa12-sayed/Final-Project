<?php
return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'),
    'sandbox' => [
        'client_id'     => env('PAYPAL_SANDBOX_CLIENT_ID'),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
        'app_id'        => 'APP-80W284485P519543T',
    ],
    'live' => [
        'client_id'     => env('PAYPAL_LIVE_CLIENT_ID'),
        'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET'),
        'app_id'        => env('PAYPAL_LIVE_APP_ID'),
    ],
    'payment_action' => 'Capture', // Changed from 'Sale' to 'Capture'
    'currency'       => 'USD', // Hardcoded to USD
    'notify_url'     => null, // Disable webhooks until properly configured
    'locale'         => 'en_US',
    'validate_ssl'   => true,
    'log'           => [
        'LogEnabled' => true,
        'FileName'   => storage_path('logs/paypal.log'),
        'LogLevel'   => 'DEBUG'
    ]
];