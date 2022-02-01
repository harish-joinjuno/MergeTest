<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpandRefinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('refinance_subscribers', function (Blueprint $table) {

            $table->string('university')->nullable();
            $table->string('program')->nullable();
            $table->timestamp('graduation_date')->nullable();
            $table->boolean('has_job_offer')->nullable();
            $table->boolean('is_working')->nullable();
            $table->string('credit_score')->nullable();
            $table->integer('annual_income')->nullable();
            $table->string('cosigner_status')->nullable();
            $table->integer('loan_amount')->nullable();
            $table->string('heard_from')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('refinance_subscribers', function (Blueprint $table) {

            $table->dropColumn('university');
            $table->dropColumn('program');
            $table->dropColumn('graduation_date');
            $table->dropColumn('has_job_offer');
            $table->dropColumn('is_working');
            $table->dropColumn('credit_score');
            $table->dropColumn('annual_income');
            $table->dropColumn('cosigner_status');
            $table->dropColumn('loan_amount');
            $table->dropColumn('heard_from');

        });
    }
}
