<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegotiationGroupUsersTable extends Migration
{

    public function up()
    {
        Schema::create('negotiation_group_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('academic_year_id');
            $table->unsignedBigInteger('negotiation_group_id');
            $table->unsignedBigInteger('negotiation_group_eligible_profile_id')->nullable();
            $table->string('status', 32);
            $table->bigInteger('amount')->nullable()->comment('in dollars without cents');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');
            $table->foreign('negotiation_group_id')->references('id')->on('negotiation_groups')->onDelete('cascade');
            $table->foreign('negotiation_group_eligible_profile_id', 'negotiation_group_eligible_profile_id_foreign')->references('id')->on('negotiation_group_eligible_profiles')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('negotiation_group_users');
    }
}
