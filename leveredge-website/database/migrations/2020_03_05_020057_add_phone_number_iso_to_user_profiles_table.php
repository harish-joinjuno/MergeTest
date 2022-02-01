<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddPhoneNumberIsoToUserProfilesTable extends Migration
{

    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('phone_number_iso', 22)->after('phone_number')->nullable();
        });

        DB::statement('alter table user_profiles modify user_id int not null after id;');
        DB::statement('alter table user_profiles modify created_at timestamp null after signup_progress');
        DB::statement('alter table user_profiles modify updated_at timestamp null after created_at');
    }

    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('phone_number_iso');
        });
    }
}
