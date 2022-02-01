<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialAidTrackersTable extends Migration
{

    public function up()
    {
        Schema::create('financial_aid_trackers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('university_id');
            $table->unsignedInteger('degree_id');
            $table->string('aid_qualification');
            $table->unsignedInteger('aid_amount');

            $table->string('immigration_status')->nullable();
            $table->integer('graduation_year')->nullable();

            $table->string('gpa')->nullable();
            $table->unsignedInteger('gmat_score')->nullable();
            $table->unsignedInteger('gre_score')->nullable();

            $table->unsignedInteger('income_3')->nullable();
            $table->unsignedInteger('income_2')->nullable();
            $table->unsignedInteger('income_1')->nullable();
            $table->unsignedInteger('current_income')->nullable();
            $table->unsignedInteger('liquid_assets')->nullable();
            $table->unsignedInteger('illiquid_assets')->nullable();
            $table->unsignedInteger('liabilities')->nullable();
            $table->unsignedInteger('total_mortgage')->nullable();
            $table->string('email')->nullable();

            $table->foreign('university_id')->references('id')->on('universities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('degree_id')->references('id')->on('degrees')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_aid_trackers');
    }
}
