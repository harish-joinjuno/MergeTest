<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveGradDataToGradColumnsInUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (\App\UserProfile::all() as $user_profile) {
            // $user_profile->grad_degree_format = $user_profile->degree_format;
            // $user_profile->degree_format = null;
            // $user_profile->grad_enrollment_status = $user_profile->enrollment_status;
            // $user_profile->enrollment_status = null;
            // $user_profile->grad_graduation_year = $user_profile->graduation_year;
            // $user_profile->graduation_year = null;
            // $user_profile->grad_degree_id = $user_profile->degree_id;
            // $user_profile->degree_id = null;
            // $user_profile->grad_university_id = $user_profile->university_id;
            // $user_profile->university_id = null;
            // $user_profile->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grad_columns_in_user_profile', function (Blueprint $table) {
            //
        });
    }
}
