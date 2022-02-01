<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGbgReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gbg_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_number')->unique();
            $table->unsignedBigInteger('individual_id');
            $table->string('type');
            $table->string('policy_holder');
            $table->date('policy_start_date');
            $table->date('policy_end_date');
            $table->string('status');
            $table->string('product',500);
            $table->string('agent_name');
            $table->string('premium_amount_currency');
            $table->decimal('premium_amount');
            $table->string('outstanding_balance_currency');
            $table->decimal('outstanding_balance');
            $table->unsignedInteger('access_the_deal_id')->nullable()->constrained('access_the_deals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gbg_reports');
    }
}
