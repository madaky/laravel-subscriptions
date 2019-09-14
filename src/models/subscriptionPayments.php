<?php

    namespace kbtechlabs\LaravelSubscriptions\Models;

    use Illuminate\Database\Eloquent\Model;

    class SubscriptionPayment extends Model
    {
        protected $fillable = [
            'id', 
        ];
        
        public function UserPlanSubscriptions(){
            $this->belongsTo(UserPlanSubscription::class);
        }
    }