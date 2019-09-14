<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanDiscountCouponsTable extends Migration
{
    use Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_discount_coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uid')->unique();
            $table->unsignedBigInteger('plan_id');
            $table->string('code',6)->unique();
            $table->integer('apply_limit');
            $table->decimal('percentage',5,2);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_discount_coupons');
    }
}
