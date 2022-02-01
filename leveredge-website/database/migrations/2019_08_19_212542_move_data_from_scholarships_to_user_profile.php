<?php

use App\UserProfile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveDataFromScholarshipsToUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach(\App\Scholarship::all() as $scholarship_record){

            // Create the User if doesn't exist
            if(!\App\User::where('email', $scholarship_record->email)->exists()){
                $user = new \App\User();
                $user->name = $scholarship_record->name;
                $user->email = $scholarship_record->email;
                $user->password = \Illuminate\Support\Facades\Hash::make(str_random(8));
                $user->save();
            }

            // Retrieve the User
            $user = \App\User::where('email',$scholarship_record->email)->first();

            // User Profile
            if(!$user->profile){
                $user_profile = new UserProfile();
                $user_profile->user_id = $user->id;
                $user_profile->save();
                $user = \App\User::where('email',$scholarship_record->email)->first();
            }

            // Determine Domestic or International
            if($scholarship_record->type == "Domestic Student"){
                $immigration_status = "U.S. Citizen or U.S. Permanent Resident";
            }else{
                $immigration_status =  "Other";
            }

            // Determine University ID
            $university_record = \App\University::where('name', $scholarship_record->university)->first();
            if($university_record){
                $university_id = $university_record->id;
            }else{
                $university_id = null;
            }

            // Determine Degree ID
            switch($scholarship_record->program){

                case "Dentistry":
                    $degree = "Dental";
                    break;

                case "DrPH":
                case "Ed.M":
                case "Ed.M.":
                case "M. Ed.":
                case "M.ED":
                case "Graduate":
                case "LLM":
                case "MA":
                case "MAM":
                case "Master in Design, GSD, Harvard":
                case "MA in Arts in Education":
                case "Master of Science in Dermatology":
                case "Masters of Arts in Social-Organizational Psychology":
                case "MHA":
                case "MPA":
                case "MPH":
                case "MPP":
                case "MSDS":
                case "Other":
                case "Nurse Practitioner":
                    $degree = "Other";
                    break;

                case "Dual Degree":
                case "MBA/MS Joint Degree":
                    $degree = "Dual Degree";
                    break;

                case "JD":
                    $degree = "JD";
                    break;

                case "Master of Advanced Management":
                case "Master of Global Management ":
                case "Master of Science in Management at Graduate School of Business":
                case "Masters in Advanced Management":
                case "Masters in Management Studies":
                case "MBA":
                case "MSX - Advanced MBA":
                    $degree = "MBA";
                    break;

                case "Master of financial engineering":
                case "Master of Science":
                case "Masters in Technology Management":
                case "MS":
                case "MS CS":
                case "MS Engineering":
                case "MS/MBA":
                    $degree = "Engineering";
                    break;

                case "MD":
                    $degree = "Medical";
                    break;

                case "Undergraduate":
                    $degree = "Undergraduate";
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
            if($scholarship_record->graduation_year > 2000){
                $graduation_year = $scholarship_record->graduation_year;
            }else{
                if($user->profile->graduation_year){
                    $graduation_year = $user->profile->graduation_year;
                }else{
                    $graduation_year = null;
                }
            }


            // Update the Profile of the User
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
        Schema::table('scholarships_to_user_profile', function (Blueprint $table) {
            //
        });
    }
}
