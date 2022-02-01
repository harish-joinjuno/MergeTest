<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFlowTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_flow_trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('unique_id')->unique();
            $table->boolean('on_test_refinance')->nullable();
            $table->boolean('on_fast_flow')->nullable();
            $table->boolean('on_loans_refinance')->nullable();
            $table->boolean('on_register')->nullable();
            $table->boolean('on_personal_info')->nullable();
            $table->boolean('on_financials')->nullable();
            $table->boolean('on_schedule')->nullable();
            $table->boolean('on_profile_end')->nullable();
            $table->boolean('on_three_questions')->nullable();
            $table->boolean('on_loan_amount_question')->nullable();
            $table->boolean('on_zip_code_question')->nullable();
            $table->boolean('on_profession_question')->nullable();
            $table->boolean('on_deal_page')->nullable();
            $table->boolean('on_hand_off')->nullable();
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
        Schema::dropIfExists('user_flow_trackings');
    }
}
