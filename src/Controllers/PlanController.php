<?php

namespace kbtechlabs\LaravelSubscriptions\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use kbtechlabs\LaravelSubscriptions\Models\Plan;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller {
    use \kbtechlabs\LaravelSubscriptions\Traits\PayPal;
    //put your code here
    public function index(){
        return view('LaravelSubscriptions::subscriptions.plans.index');
    }
    
    public function create(Request $request){
        Plan::create([
            'name'=>$request->post('plan'),
            'price'=>$request->post('price'),
            'durations'=>$request->post('duration'),
            'description'=> $request->has('description') ? $request->post('description') : null,
            'limit'=> $request->has('limit') ?   $request->post('limit'): null,
            'limit_use'=> $request->has('limit_use') ?   $request->post('limit_use'): null,
            'start_at'=> $request->has('start_at') ?    $request->post('start_at'): null,
            'ends_at'=> $request->has('ends_at') ? $request->post('ends_at'): null,
        ]);
        die();
    }
    
    public function getPayment(Request $request) {
        return $this->getPaymentStatus($request);        
    }
    public function failedPayment() {
        return view('LaravelSubscriptions::subscriptions.errors.payments.failed');
    }
}
