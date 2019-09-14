<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPlanInvoices extends Migration
{
    use Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plan_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uid')->unique();
            $table->string('bill_id')->nullable();
            $table->unsignedBigInteger('user_plan_payment_id')->nullable();
            $table->float('amount');
            $table->boolean('is_paid')->comment('0=>false,1=>true');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_plan_payment_id')->references('id')->on('user_plan_payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_plan_invoices');
    }
}
