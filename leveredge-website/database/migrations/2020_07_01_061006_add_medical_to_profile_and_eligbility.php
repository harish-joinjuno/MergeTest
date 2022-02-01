<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicalToProfileAndEligbility extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negotiation_group_eligible_profiles', function (Blueprint $table) {
            $table->boolean('is_medical')->nullable();
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->boolean('is_medical')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('negotiation_group_eligible_profiles', function (Blueprint $table) {
            $table->dropColumn('is_medical')->nullable();
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('is_medical')->nullable();
        });
    }
}
