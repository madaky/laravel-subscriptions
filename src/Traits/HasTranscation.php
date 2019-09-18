<?php
namespace kbtechlabs\LaravelSubscriptions\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait HasTranscation {
    use HasSubscription;
   
    public function getTransactionByPaymentId(){
        return config('laravel-subscriptions.models.transaction')::where('txn_id',$this->paymentId)
                        ->where('payment_status','Like','TXN_PENDING')
                        ->first();
    }
    
//    public function checkTransactionSubscription(){
//        $currentTranscation = $this->getSuccessTranscation();
//        if( !is_null($currentTranscation)){
//            if($currentTranscation->first()->subscription()->first()){
//                
//            }
//            dd();
//        }
//    }
    
//    public function getSubscription(){
//        
//    }
    
    public function getSuccessTranscation(){
        return config('laravel-subscriptions.models.transaction')::where('txn_id',$this->paymentId)
                       ->where('is_success',1);
    }
    
    
    
    
    
 }
