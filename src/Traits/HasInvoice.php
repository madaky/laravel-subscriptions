<?php
namespace kbtechlabs\LaravelSubscriptions\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Carbon\Carbon;
trait HasInvoice {
    use UseUuid;
    public function generateInvoice($transaction){
        if($transaction->invoice()->first()){
            return ;
        }
        $inv = config('laravel-subscriptions.models.invoice');
        $invoice = new $inv;
        $invoice->user_plan_transaction_id = $transaction->id;
        $invoice->amount = $transaction->amount;
        $invoice->is_paid = $transaction->is_success ? $transaction->is_success : 0;
        $invoice->save();
    }
 }
