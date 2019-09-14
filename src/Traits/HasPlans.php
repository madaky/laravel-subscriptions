<?php
namespace kbtechlabs\LaravelSubscriptions\Traits;


trait HasPlans {
    
    protected $plans;
    
    /*
     * usre  Belongs to many plans by suscribing it
     */
    public function plans(){
       return $this->belongsToMany(config('laravel-subscriptions.models.plan'),'user_plan_subscriptions'); 
    }
    
    /*
     * 
     */
    public function attachSubscriptions($plan)
    {
        
        if ($this->getPlans()->contains($plan)) {
            return true;
        }
        $this->plans = null;
        return $this->plans()->attach($plan);
    }
    
    public function getPlans(){
        return (!$this->plans) ? $this->plans = $this->plans()->get() : $this->plans;
    }
    
    public function checkPlan($plan)
    {
        return $this->getSubscriptions()->contains(function ($value) use ($plan) {
            return $plan == $value->id;
        });
    }
}
