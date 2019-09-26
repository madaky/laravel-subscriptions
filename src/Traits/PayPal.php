<?php
namespace kbtechlabs\LaravelSubscriptions\Traits;

use Illuminate\Support\Str;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Schema;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use Illuminate\Support\Facades\Redirect;
use kbtechlabs\LaravelSubscriptions\Models\UserPlanTranscation;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
trait PayPal {
    Use HasTranscation;
    Use HasInvoice;
    protected $apiContext;
    protected $paymentId;
    public function generatePayment(Request $request){
        $this->getApiContext();
        $cPlan = $this->getCurrentPlan();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item = new Item();
        $item->setName('Paypal Payment')
                ->setCurrency('INR')
                ->setQuantity(1)
                ->setPrice($cPlan->price);
        $itemList = new ItemList();
        $itemList->setItems(array($item));
        $amount = new Amount();
        $amount->setCurrency('INR')->setTotal($cPlan->price);
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($itemList);
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('processPayment'))
        ->setCancelUrl(url()->current());
        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
        try {
            $payment->create($this->apiContext);
        } catch (PayPalConnectionException $ex){
           dd($ex);
        } catch (Exception $ex) {
            dd($ex);
        }
        $this->generateTransaction($payment);
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        if(isset($redirect_url)) {
            if(!$request->isXmlHttpRequest()){
                Redirect::away($redirect_url)->send();
            }else{
                return response()->json($redirect_url);
            }
        }
    }
    
    public function getApiContext(){
         $this->apiContext = new ApiContext(
            new OAuthTokenCredential(config('laravel-subscriptions.paypal.client_id'), config('laravel-subscriptions.paypal.secret'))
        );
        $this->apiContext->setConfig(config('laravel-subscriptions.paypal.settings'));
    }
    
    public function getPaymentStatus($request){
        $this->getApiContext();
        if (!$request->has('PayerID') || !$request->has('token')) {
           return Redirect::route('paymentfailed') ;
        }
        $this->paymentId = $request->input('paymentId');
        $paymentTransactions = $this->getTransactionByPaymentId();
        if(is_null($paymentTransactions)){
            $paymentTransactions = $this->getSuccessTranscation()->first();
            if($paymentTransactions->userplan()->first()->is_active ==1 ){
                return redirect('/');
            }
            dd('User Allready approved the transaction or Norelevant data found');
        }
        $paymentId = $paymentTransactions->txn_id;
        $payment = Payment::get($paymentId, $this->apiContext);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);
        //dd( $result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {
            $paymentTransactions->payment_status = 'TXN_SUCCESS'; 
            $paymentTransactions->is_success = true;
            $paymentTransactions->save();
            /** 
             * Future
             * make a event to listen the trnsaction change and 
             * convert the userplan Invoice and  subscription model
             * accrodingly
             */
            $planUpdate = $paymentTransactions->userplan()->first();
            $planUpdate->is_active = 1;
            $planUpdate->save();
            $this->generateSubscription($paymentTransactions);
            $this->generateInvoice($paymentTransactions);
                //Auth::login($paymentTransactions->user());
                return redirect('/')->with(['message'=>'Transaction Succesful!!, Login to continue..','type'=>'success']);
        }
        Session::put('error','Payment failed');
        return Redirect::route('addmoney.paywithpaypal');
    }
}
