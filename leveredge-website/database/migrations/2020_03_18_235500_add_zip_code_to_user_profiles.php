<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddZipCodeToUserProfiles extends Migration
{

    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('zip_code')->nullable();
        });
    }

    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('zip_code');
        });
    }
}
