<?php
namespace kbtechlabs\LaravelSubscriptions\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Carbon\Carbon;
trait HasSubscription {
    use UseUuid;
    public function generateSubscription($transcation){
        if($transcation->subscription()->first()){
            return ;
        }
        $plan = $transcation->plan()->first();
        $subs = config('laravel-subscriptions.models.subscription');
        $subscription = new $subs;
        $subscription->user_plan_id  = $transcation->user_plan_id;
        $subscription->balance_limit  = $plan->limit ? $plan->limit: 0;
        $subscription->balance_days  = $plan->durations;
        $subscription->started_at  = $transcation->updated_at;
        $subscription->ends_at  = carbon::parse($transcation->updated_at)->addDays($subscription->balance_days);
        $subscription->is_expired  = 0;
        $subscription->save();
    }
    
 }