<?php

use App\UserProfile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveDataFromInschoolSubscribersToUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (\Illuminate\Support\Facades\DB::table('inschool_subscribers')->get() as $in_school_record) {

            // Create the User if doesn't exist
            if (!\App\User::where('email', $in_school_record->email)->exists()) {
                $user           = new \App\User();
                $user->name     = $in_school_record->name;
                $user->email    = $in_school_record->email;
                $user->password = \Illuminate\Support\Facades\Hash::make(str_random(8));
                $user->save();
            }

            // Retrieve the User
            $user = \App\User::where('email',$in_school_record->email)->first();

            // Make a User Profile If It Doesn't Exist
            if (!$user->profile) {
                $user_profile          = new UserProfile();
                $user_profile->user_id = $user->id;
                $user_profile->save();
                $user = \App\User::where('email',$in_school_record->email)->first();
            }

            // Determine Domestic or International
            if ($in_school_record->type == "Domestic Student") {
                if ($user->profile->immigration_status == "Other") {
                    $immigration_status =  "Other";
                } else {
                    $immigration_status = "U.S. Citizen or U.S. Permanent Resident";
                }
            } else {
                $immigration_status =  "Other";
            }

            // Determine University ID
            $university_record = \App\University::where('name', $in_school_record->university)->first();
            if ($university_record) {
                $university_id = $university_record->id;
            } else {
                if ($user->profile->university_id) {
                    $university_id = $user->profile->university_id;
                } else {
                    $university_id = null;
                }
            }

            // Determine Degree
            switch ($in_school_record->degree) {

                case "Undergraduate":
                    $degree = "Undergraduate";

                    break;

                case "Dentistry":
                    $degree = "Dental";

                    break;

                case "MS/MBA":
                case "design/engineering + mba":
                case "Dual MBA / MPP":
                case "MBA / MA":
                case "MBA/MS Joint Degree":
                    $degree = "Dual Degree";

                    break;

                case "JD":
                    $degree = "JD";

                    break;

                case "MS":
                case "MS. Real Estate Development":
                case "MSDS":
                case "Nurse Practitioner":
                case "Pharmacist":
                case "LLM":
                case "M.ED":
                case "MA":
                case "MA in Arts in Education":
                case "MGM":
                case "Master of Science in Dermatology":
                case "Master's in Environmental Management":
                case "Masters of Arts in Social-Organizational Psychology":
                case "MPP":
                case "MPA":
                    $degree = "Other";

                    break;

                case "Master of Global Management":
                case "Master of Advanced Management":
                case "MBA":
                    $degree = "MBA";

                    break;

                case "MS Civil Engineering":
                case "MS CS":
                case "MS Engineering":
                case "Master of Science":
                case "Master of Engineering":
                case "Master of financial engineering":
                case "Masters in Computer Science":
                case "Masters in Finance":
                case "Masters in Technology Management":
                    $degree = "Engineering";

                    break;

                case "MD":
                    $degree = "Medical";

                    break;

                case "Pursuing one degree":
                default:
                    $degree = "";

                    break;
            }

            if ($degree == "") {
                if ($user->profile->degree_id) {
                    $degree_id =  $user->profile->degree_id;
                } else {
                    $degree_id = null;
                }
            } else {
                $degree_id = \App\Degree::where('name',$degree)->first()->id;
            }

            // Determine the Graduation Year
            if ($in_school_record->grad_year > 2000) {
                $graduation_year = $in_school_record->grad_year;
            } else {
                if ($user->profile->graduation_year) {
                    $graduation_year = $user->profile->graduation_year;
                } else {
                    $graduation_year = null;
                }
            }


            // Determine the Credit Score
            switch ($in_school_record->credit_score) {


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
            switch ($in_school_record->cosigner_status) {

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
                    if ($user->profile->cosigner_status) {
                        $cosigner_status = $user->profile->cosigner_status;
                    } else {
                        $cosigner_status = null;
                    }

                    break;
            }

            // Annual Income
            if ( $in_school_record->annual_income ) {
                $annual_income = $in_school_record->annual_income;
            } else {
                $annual_income = null;
            }

            // Update or Create the User Profile
            UserProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'immigration_status' => $immigration_status,
                    'application_status' => 'Current Student',

                    // School Related
                    'university_id'     => $university_id,
                    'degree_id'         => $degree_id,
                    'enrollment_status' => 'Full-Time',
                    'degree_format'     => 'On Campus',
                    'graduation_year'   => $graduation_year,

                    // Finance Related
                    'credit_score'    => $credit_score,
                    'cosigner_status' => $cosigner_status,
                    'annual_income'   => $annual_income,
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

    }
}
