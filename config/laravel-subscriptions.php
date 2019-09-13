<?php

return [
    //
    
    'models'=>[
        'plan' => \kbtechlabs\LaravelSubscription\Models\Plan::class,
        'subscription' => \kbtechlabs\LaravelSubscription\Models\UserPlanSubscription::class,
        'subscriptionPayment' => \kbtechlabs\LaravelSubscription\Models\SubscriptionPayment::class
    ],
];