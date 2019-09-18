<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPlantransactionsTables extends Migration
{
    use Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plan_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_plan_id')->unique();
            $table->uuid('uid')->unique();
            $table->string('txn_id');
            $table->float('amount');
            $table->string('payment_status')->comment('TXN_PENDING,TXN_SUCCESS,TXN_FAILURE,TXN_CANCLED');
            $table->boolean('is_success')->nullable()->comment('0=>failed,1=>success');
            $table->string('payment_gateway')->comment('PAYPAL, PAYTM, CASH');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_plan_id')->references('id')->on('user_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_payments_tables');
    }
}
