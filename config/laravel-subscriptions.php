<?php

return [
    //
    
    'models'=>[
        'plan' => \kbtechlabs\LaravelSubscriptions\Models\Plan::class,
        'subscription' => \kbtechlabs\LaravelSubscriptions\Models\UserPlanSubscription::class,
        'subscriptionPayment' => \kbtechlabs\LaravelSubscriptions\Models\SubscriptionPayment::class
    ],
];