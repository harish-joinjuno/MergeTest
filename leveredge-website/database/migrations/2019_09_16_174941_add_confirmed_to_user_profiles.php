<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConfirmedToUserProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Default is 1 because all new records would be created based on user input
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->boolean('is_confirmed_with_user')->default(1);
        });

        // Because Default is 1, we need to run an update to make the existing profiles 0
        \Illuminate\Support\Facades\DB::table('user_profiles')->update(['is_confirmed_with_user' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('is_confirmed_with_user');
        });
    }
}
