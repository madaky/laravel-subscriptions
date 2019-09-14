<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPlanPaymentsTables extends Migration
{
    use Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plan_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_plan_id');
            $table->uuid('uid')->unique();
            $table->float('amount');
            $table->boolean('is_discount')->default(0)->comment('0=>false, 1=>true');
            $table->float('discount_amount')->nullable();
            $table->unsignedBigInteger('discount_coupon_id')->nullable();
            $table->string('payment_status')->comment('TXN_PENDING,TXN_SUCCESS,TXN_FAILURE');
            $table->boolean('is_success')->nullable()->comment('0=>failed,1=>success');
            $table->string('payment_gateway')->comment('PAYPAL, PAYTM');
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
