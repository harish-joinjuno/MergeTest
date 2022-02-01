<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpandInschoolSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inschool_subscribers', function (Blueprint $table) {

            $table->string('university')->nullable();
            $table->string('degree')->nullable();
            $table->timestamp('graduation_year')->nullable();
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
        Schema::table('inschool_subscribers', function (Blueprint $table) {

            $table->dropColumn('university');
            $table->dropColumn('degree');
            $table->dropColumn('graduation_year');
            $table->dropColumn('credit_score');
            $table->dropColumn('annual_income');
            $table->dropColumn('cosigner_status');
            $table->dropColumn('loan_amount');
            $table->dropColumn('heard_from');

        });
    }
}
