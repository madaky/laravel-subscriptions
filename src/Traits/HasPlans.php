<?php
namespace kbtechlabs\LaravelSubscriptions\Traits;

use Illuminate\Support\Arr;
use kbtechlabs\LaravelSubscriptions\Models\PlanDiscountCoupon;
use kbtechlabs\LaravelSubscriptions\Models\UserPlanTransaction;
use Illuminate\Support\Str;
trait HasPlans {
    use PayPal;
    protected $plans;
    protected $currentPlan;
    protected $data;
    /*
     * usre  Belongs to many plans by suscribing it
     */
    public function plans(){
       return $this->belongsToMany(config('laravel-subscriptions.models.plan'),'user_plans'); 
    }
    
    public function attachSubscriptions($plan, $data)
    {
        if ($this->getPlans()->contains($plan)) {
            return true;
        }
        $this->plans = null;
        $this->currentPlan = $plan;
        $this->data = $data;
        $this->plans()->attach($plan,$this->generatePlanData());
        return $this->generatePayment();
    }
    
    public function getPlans(){
        return (!$this->plans) ? $this->plans = $this->plans()->get() : $this->plans;
    }
    
    public function checkPlan($plan)
    {
        return $this->plans()->contains(function ($value) use ($plan) {
            return $plan == $value->id;
        });
    }
    
    public function getCurrentPlan(){
        return $this->plans()->first();
    }
    
    public function generatePlanData(){
        $data = $this->data;
        $planData = [
                        'uid'=> Str::uuid(),
                        'plan_amount'=>$this->currentPlan->price,
                        'is_active'=>2,
                        'total_amount'=>$this->currentPlan->price,
                    ];
        $couponData=[];
        if(Arr::has($data,'coupon_code')){
            $couponBase = PlanDiscountCoupon::where('code','LIKE','%'.$data['coupon_code'].'%')->first();
            $disPrice = ($this->currentPlan->price * $couponBase->percentage)/100;
            $couponData = [
                'is_discount'=>true,
                'discount_amount' => $disPrice,
                'discount_coupon_id'=> $couponBase->id,
                'total_amount'=> $currentPlan->price - $disPrice
            ];
        }
        
        return array_merge($planData, $couponData);
    }
    
    public function generateTransaction($payment){
       $userPlan = $this->plans()->where('is_active',2)->withPivot('id','total_amount')->first();
       $newTranscation = new UserPlanTransaction();
       $newTranscation->uid = Str::uuid();
       $newTranscation->txn_id = $payment->id;
       $newTranscation->amount = $userPlan->pivot->total_amount;
       $newTranscation->payment_status = 'TXN_PENDING';
       $newTranscation->payment_gateway = Str::upper(trim($this->data['submit']));
       $newTranscation->user_plan_id = $userPlan->pivot->id;
       $newTranscation->save();
    }
}
