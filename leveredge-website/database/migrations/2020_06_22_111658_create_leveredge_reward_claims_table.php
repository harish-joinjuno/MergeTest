<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeveredgeRewardClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leveredge_reward_claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('deal_id');
            $table->unsignedInteger('payment_method_id');
            $table->unsignedInteger('reward_amount');
            $table->unsignedInteger( 'loan_amount');

            $table->unsignedInteger('access_the_deal_id')->nullable();
            $table->unsignedInteger('payment_id')->nullable();

            $table->boolean('is_paid')->default(0);
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leveredge_reward_claims');
    }
}
