<?php

    namespace kbtechlabs\LaravelSubscriptions\Models;

    use Illuminate\Database\Eloquent\Model;
    use kbtechlabs\LaravelSubscriptions\Traits\UseUuid;
    class UserPlanSubscription extends Model
    {
        use  UseUuid;
        
        protected $fillable = [
            'id', 
        ];
        
        public function userplan(){
            return $this->belongsTo(config('laravel-subscriptions.models.userPlan'),'user_plan_id');
        }
        
        public function user(){
            return $this->hasOneThrough('App\user',config('laravel-subscriptions.models.userPlan'),'user_id','id');
        }
        public function plan(){
            return $this->hasOneThrough(\App\User::class, config('laravel-subscriptions.models.userPlan'));
        }
    }