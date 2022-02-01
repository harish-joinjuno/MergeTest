<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_amounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_profile_id');
            $table->enum('semester', ['fall', 'spring', 'summer']);
            $table->integer('year');
            $table->integer('amount')->nullable(true);
            $table->timestamps();
            $table->unique(['user_profile_id', 'semester', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_amounts');
    }
}
