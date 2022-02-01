<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveWireEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_wire_entries', function (Blueprint $table) {


            $table->increments('id');

            // Information about the loan
            $table->string('product');
            $table->decimal('interest_rate',8,4);
            $table->string('type')->nullable(); //fixed or variable
            $table->string('term')->nullable();
            $table->integer('lender_id')->nullable();

            // Information about the applicant
            $table->integer('university_id')->nullable();
            $table->integer('degree_id')->nullable();
            $table->string('credit_score')->nullable();
            $table->boolean('co_signer')->nullable();

            $table->boolean('accepted_offer')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();

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
        Schema::dropIfExists('live_wire_entries');
    }
}
