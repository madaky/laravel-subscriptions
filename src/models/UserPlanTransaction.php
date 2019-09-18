<?php

    namespace kbtechlabs\LaravelSubscriptions\Models;

    use Illuminate\Database\Eloquent\Model;
    use kbtechlabs\LaravelSubscriptions\Traits\UseUuid;
    class UserPlanTransaction extends Model
    {
        use  UseUuid;
        
        protected $fillable = [
            'id', 
        ];
        
        public function userplan(){
            return $this->belongsTo(config('laravel-subscriptions.models.userPlan'),'user_plan_id');
        }
        
        public function user(){
            return $this->hasOneThrough(\App\User::class,config('laravel-subscriptions.models.userPlan'),'id','id','user_plan_id','user_id');
        }
        public function plan(){
            return $this->hasOneThrough(config('laravel-subscriptions.models.plan'), config('laravel-subscriptions.models.userPlan'),'id','id','user_plan_id','plan_id');
        }
        public function subscription(){
            return $this->hasOneThrough(config('laravel-subscriptions.models.subscription'), config('laravel-subscriptions.models.userPlan'),'id','','user_plan_id');
        }
        
        public function invoice(){
            return $this->hasOne(config('laravel-subscriptions.models.invoice'),'user_plan_transaction_id');
        }
    }