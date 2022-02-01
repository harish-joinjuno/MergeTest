<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyLoanTypeInUserProfilesTable extends Migration
{

    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('loan_type')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {

        });
    }
}
