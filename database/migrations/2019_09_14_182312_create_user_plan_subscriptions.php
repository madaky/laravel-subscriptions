<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPlanSubscriptions extends Migration
{
    use Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plan_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uid')->unique();
            $table->unsignedBigInteger('user_plan_id')->unique();
            $table->integer('balance_limit');
            $table->integer('balance_days');
            $table->dateTime('started_at');
            $table->dateTime('ends_at');
            $table->boolean('is_expired')->comment('0=>false,1=>true');
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
        Schema::dropIfExists('user_plan_subscriptions');
    }
}
