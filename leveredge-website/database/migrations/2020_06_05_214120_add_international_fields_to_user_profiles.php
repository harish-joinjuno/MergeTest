<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInternationalFieldsToUserProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->integer('country_of_citizenship_id')->nullable();
            $table->integer('country_of_residence_id')->nullable();
            $table->integer('visa_id')->nullable();
            $table->string('cosigner_immigration_status')->nullable();
            $table->integer('cosigner_country_of_citizenship_id')->nullable();
            $table->integer('cosigner_country_of_residence_id')->nullable();
            $table->integer('cosigner_visa_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('country_of_citizenship_id');
            $table->dropColumn('country_of_residence_id');
            $table->dropColumn('visa_id');
            $table->dropColumn('cosigner_immigration_status');
            $table->dropColumn('cosigner_country_of_citizenship_id');
            $table->dropColumn('cosigner_country_of_residence_id');
            $table->dropColumn('cosigner_visa_id');

        });
    }
}
