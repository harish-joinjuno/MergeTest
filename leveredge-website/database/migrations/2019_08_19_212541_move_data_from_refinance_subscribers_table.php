<?php

use App\UserProfile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveDataFromRefinanceSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (\Illuminate\Support\Facades\DB::table('refinance_subscribers')->get() as $refinance_record) {

            // Create the User if doesn't exist
            if (!\App\User::where('email', $refinance_record->email)->exists()) {
                $user           = new \App\User();
                $user->name     = $refinance_record->name;
                $user->email    = $refinance_record->email;
                $user->password = \Illuminate\Support\Facades\Hash::make(str_random(8));
                $user->save();
            }

            // Retrieve the User
            $user = \App\User::where('email',$refinance_record->email)->first();

            // Create the User Profile If It Doesn't Exist
            if (!$user->profile) {
                $user_profile          = new UserProfile();
                $user_profile->user_id = $user->id;
                $user_profile->save();
                $user = \App\User::where('email',$refinance_record->email)->first();
            }

            // Determine Domestic or International
            if ($refinance_record->type == "Domestic Student") {
                $immigration_status = "U.S. Citizen or U.S. Permanent Resident";
            } else {
                $immigration_status =  "Other";
            }

            // Determine University ID
            $university_record = \App\University::where('name', $refinance_record->university)->first();
            if ($university_record) {
                $university_id = $university_record->id;
            } else {
                $university_id = null;
            }

            // Determine Degree
            switch ($refinance_record->program) {
                case "Dentistry":
                    $degree = "Dental";

                    break;

                case "design/engineering + mba":
                case "Dual MBA / MPP":
                case "MBA / MA":
                case "MBA/MS Joint Degree":
                    $degree = "Dual Degree";

                    break;

                case "JD":
                    $degree = "JD";

                    break;

                case "MHA":
                case "MPH":
                case "DrPH":
                case "Ed.M":
                case "Ed.M.":
                case "Graduate":
                case "M. Ed.":
                case "LLM":
                case "M.ED":
                case "MA":
                case "MA in Arts in Education":
                case "MGM":
                case "Master of Science in Dermatology":
                case "Master's in Environmental Management":
                case "Master's of Science in Anesthesia":
                case "Master in Design, GSD, Harvard":
                case "Other Masters":
                    $degree = "Other";

                    break;

                case "MSX - Advanced MBA":
                case "MAM":
                case "Master of Global Management":
                case "Master of Advanced Management":
                case "MBA":
                case "Masters in Advanced Management":
                case "Masters in Management Studies":
                    $degree = "MBA";

                    break;

                case "Master of Science":
                case "Master of Engineering":
                case "Master of financial engineering":
                case "Masters in Computer Science":
                case "Masters in Finance":
                case "Masters in Technology Management":
                case "MS":
                    $degree = "Engineering";

                    break;

                case "MD":
                    $degree = "Medical";

                    break;


                case "Undergraduate":
                    $degree = "Undergraduate";

                    break;

                default:
                    $degree = "";

                    break;
            }

            if ($degree == "") {
                $degree_id = null;
            } else {
                $degree_id = \App\Degree::where('name',$degree)->first()->id;
            }


            // Determine the Graduation Year
            if ($refinance_record->graduation_date && \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $refinance_record->graduation_date)->year > 2000) {
                $graduation_year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $refinance_record->graduation_date)->year;
            } else {
                if ($user->profile->graduation_year) {
                    $graduation_year = $user->profile->graduation_year;
                } else {
                    $graduation_year = null;
                }
            }


            // Determine the Credit Score
            switch ($refinance_record->credit_score) {

                case "550 to 649":
                    $credit_score = "550 - 649";

                    break;

                case "650 to 699":
                    $credit_score = "650 - 699";

                    break;

                case "700 to 749":
                    $credit_score = "700 - 749";

                    break;

                case "750 to 799":
                    $credit_score = "750 - 799";

                    break;

                case "800 and above":
                    $credit_score = "Above 800";

                    break;

                case "Below 550":
                    $credit_score = "Below 550";

                    break;

                case "No Credit Score":
                    $credit_score = "I don't have a Credit Score";

                    break;

                default:
                    $credit_score = null;

                    break;
            }



            // Determine Co-Signer Status
            switch ($refinance_record->cosigner_status) {

                case "I am not sure":
                    $cosigner_status = "Maybe";

                    break;

                case "Yes, I have an International co-signer":
                case "No, I don't have a co-signer":
                    $cosigner_status = "No";

                    break;

                case "Yes, I have a US Citizen / Permanent Resident co-signer":
                    $cosigner_status = "Yes";

                    break;

                default:
                    $cosigner_status = null;

                    break;
            }


            // Update or Create the User Profile
            UserProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'immigration_status' => $immigration_status,
                    'application_status' => 'Graduated',

                    // School Related
                    'university_id'     => $university_id,
                    'degree_id'         => $degree_id,
                    'enrollment_status' => 'Full-Time',
                    'degree_format'     => 'On Campus',
                    'graduation_year'   => $graduation_year,

                    // Finance Related
                    'credit_score'    => $credit_score,
                    'cosigner_status' => $cosigner_status,
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
        Schema::table('refinance_subscribers', function (Blueprint $table) {
            //
        });
    }
}
