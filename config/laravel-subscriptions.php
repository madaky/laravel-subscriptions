<?php

return [
    //
    'models'=>[
        'plan' => \kbtechlabs\LaravelSubscriptions\Models\Plan::class,
        'userPlan' =>\kbtechlabs\LaravelSubscriptions\Models\UserPlan::class,
        'transaction' => \kbtechlabs\LaravelSubscriptions\Models\UserPlanTransaction::class,
        'subscription' => \kbtechlabs\LaravelSubscriptions\Models\UserPlanSubscription::class,
        'invoice' => \kbtechlabs\LaravelSubscriptions\Models\UserPlanInvoice::class,
    ],
    'paypal'=>[
                'client_id' => env('PAYPAL_CLIENT_ID',''),
                'secret' => env('PAYPAL_SECRET',''),
                'settings' => [
                    'mode' => env('PAYPAL_MODE','sandbox'), //Option 'sandbox' or 'live', sandbox for testing
                    'http.ConnectionTimeOut' => 1000, //Max request time in seconds
                    'log.LogEnabled' => true, //Whether want to log to a file
                    'log.FileName' => storage_path() . '/logs/paypal.log', //Specify the file that want to write on
                    'log.LogLevel' => 'FINE' //Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
                ],
    ]
];