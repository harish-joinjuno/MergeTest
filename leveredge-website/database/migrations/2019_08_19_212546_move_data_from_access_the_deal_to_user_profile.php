<?php

use App\AccessTheDeal;
use App\User;
use App\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveDataFromAccessTheDealToUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        foreach(AccessTheDeal::all() as $access_record){

            // Create the User if doesn't exist
            if(!User::where('email', $access_record->email)->exists()){
                $user = new User();
                $user->name = $access_record->name;
                $user->email = $access_record->email;
                $user->password = Hash::make(str_random(8));
                $user->save();
            }

            // Retrieve the User
            $user = User::where('email',$access_record->email)->first();

            // Check if the User has a User Profile
            if(!$user->profile){
                $user_profile = new UserProfile();
                $user_profile->user_id = $user->id;
                $user_profile->save();
                $user = User::where('email',$access_record->email)->first();
            }

            // Determine University ID
            $university_record = \App\University::where('name', $access_record->university)->first();
            if($university_record){
                $university_id = $university_record->id;
            }else{
                // Check if the User Already Has A University ID
                if($user->profile->university_id){
                    $university_id = $user->profile->university_id;
                }else{
                    $university_id = null;
                }
            }


            // Determine Degree ID
            switch ($access_record->degree){

                case "business":
                    $degree = "MBA";
                    break;

                case "dental":
                    $degree = "Dental";
                    break;

                case "dual_degree":
                    $degree = "Dual Degree";
                    break;

                case "engineering":
                    $degree = "Engineering";
                    break;

                case "law":
                    $degree = "JD";
                    break;

                case "medicine":
                    $degree = "Medical";
                    break;

                case "nursingma":
                    $degree = "Nursing";
                    break;

                case "undergraduate":
                    $degree = "Undergraduate";
                    break;

                case "physicians_assistant":
                    $degree = "Physician's Assistant";
                        break;

                case "refinance":
                case "notlisted":
                default:
                    $degree = "";
                    break;
            }

            if($degree == ""){

                if($user->profile->degree_id){
                    $degree_id = $user->profile->degree_id;
                }else{
                    $degree_id = null;
                }
            }else{
                $degree_id = \App\Degree::where('name',$degree)->first()->id;
            }

            // Determine the Graduation Year
            if($access_record->graduation_year > 2000){
                $graduation_year = $access_record->graduation_year;
            }else{
                if($user->profile->graduation_year){
                    $graduation_year = $user->profile->graduation_year;
                }else{
                    $graduation_year = null;
                }
            }


            $immigration_status = 'U.S. Citizen or U.S. Permanent Resident';
            if($user->profile->immigration_status){
                $immigration_status = $user->profile->immigration_status;
            }

            // Update or Create the User Profile
            UserProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'immigration_status' => $immigration_status,
                    'application_status' => 'Current Student',

                    // School Related
                    'university_id' => $university_id,
                    'degree_id' => $degree_id,
                    'graduation_year' => $graduation_year,
                    'enrollment_status' => 'Full-Time',
                    'degree_format' => 'On Campus'
                ]
            );

        }





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_the_deal_to_user_profile', function (Blueprint $table) {
            //
        });
    }
}
