<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegotiationGroupEligibleProfilesTable extends Migration
{

    public function up()
    {
        Schema::create('negotiation_group_eligible_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('negotiation_group_id');
            $table->unsignedInteger('university_id')->nullable();
            $table->unsignedInteger('degree_id')->nullable();
            $table->unsignedInteger('grad_degree_id')->nullable();
            $table->unsignedInteger('grad_university_id')->nullable();

            $table->unsignedBigInteger('annual_income_min')->nullable();
            $table->unsignedBigInteger('annual_income_max')->nullable();

            $table->string('degree_type', 32)->nullable();
            $table->string('immigration_status', 128)->nullable();
            $table->string('credit_score', 64)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('negotiation_group_id')->references('id')->on('negotiation_groups')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('negotiation_group_eligible_profiles');
    }
}
