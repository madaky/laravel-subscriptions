<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPaymentsTables extends Migration
{
    use Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_plan_subcription_id');
            $table->bigInteger('token_id');
            $table->boolean('payment_method')->default(1)->comment('0=>offline/cash,1=>Online');
            $table->boolean('payment_status')->default(2)->comment('0=>failed,2=>pending,1=>success,3=>open');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_plan_subcription_id')->references('id')->on('user_plan_subscriptions');
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
