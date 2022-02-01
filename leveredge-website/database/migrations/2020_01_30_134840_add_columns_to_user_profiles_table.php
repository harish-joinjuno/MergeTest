<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('utm_content')->nullable()->after('user_id');
            $table->string('utm_term')->nullable()->after('user_id');
            $table->string('utm_campaign')->nullable()->after('user_id');
            $table->string('utm_medium')->nullable()->after('user_id');
            $table->string('utm_source')->nullable()->after('user_id');
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
            $table->dropColumn('utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content');
        });
    }
}
