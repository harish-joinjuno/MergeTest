<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialAidTrackerEligibleProgramsTable extends Migration
{

    public function up()
    {
        Schema::create('financial_aid_tracker_eligible_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('university_id');
            $table->unsignedInteger('degree_id');
            $table->unsignedInteger('average_reported_aid_amount');

            $table->foreign('university_id')->references('id')->on('universities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('degree_id')->references('id')->on('degrees')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_aid_tracker_eligible_programs');
    }
}
