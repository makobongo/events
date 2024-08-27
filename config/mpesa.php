<?php

return [

    'credentials' => [
        'consumer_key' => env('MPESA_CONSUMER_KEY'),
        'consumer_secret' => env('MPESA_CONSUMER_SECRET'),
        'mpesa_env' => env('MPESA_ENV'),
        'mpesa_url' => env('MPESA_URL'),
        'pass_key' => env('MPESA_PASS_KEY'),
        'call_back_url' => env('CALL_BACK_URL')
    ]

];
