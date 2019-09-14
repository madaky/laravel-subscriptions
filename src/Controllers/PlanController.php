<?php

namespace kbtechlabs\LaravelSubscriptions\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use kbtechlabs\LaravelSubscriptions\Models\Plan;

class PlanController extends Controller {
    //put your code here
    public function index(){
        return view('LaravelSubscriptions::subscriptions.plans.index');
    }
    
    public function create(Request $request){
        print_r($request->post());
        Plan::create([
            'name'=>$request->post('plan'),
            'price'=>$request->post('price'),
            'durations'=>$request->post('duration'),
        ]);
        die();
        
    }
}
