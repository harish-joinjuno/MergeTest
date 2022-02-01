<?php

use Illuminate\Database\Seeder;

class ReferralProgramsTableSeeder extends Seeder
{
    public function run()
    {
        $today = \Carbon\Carbon::today();

        $referral_program               = new \App\ReferralProgram();
        $referral_program->name         = 'Two Side 25 With Milestone Prizes';
        $referral_program->display_name = 'MBA Referral Program';
        $referral_program->slug         = 'two-side-with-milestone-prizes';
        $referral_program->priority     = 1;
        $referral_program->save();

        $referral_program_eligible_profile                      = new \App\ReferralProgramEligibleProfile();
        $referral_program_eligible_profile->referral_program_id = $referral_program->id;
        $referral_program_eligible_profile->created_on_or_after = '2019-01-01';
        $referral_program_eligible_profile->grad_degree_id      = \Illuminate\Support\Facades\DB::table('degrees')->where('name','MBA')->first()->id;
        $referral_program_eligible_profile->save();

        $referral_program               = new \App\ReferralProgram();
        $referral_program->name         = 'Two Side 25 With Scholarship Pot Option';
        $referral_program->display_name = 'Default Referral Program';
        $referral_program->slug         = 'two-side-with-scholarship-pot';
        $referral_program->priority     = 2;
        $referral_program->save();

        $referral_program_eligible_profile                      = new \App\ReferralProgramEligibleProfile();
        $referral_program_eligible_profile->referral_program_id = $referral_program->id;
        $referral_program_eligible_profile->created_on_or_after = $today->format('Y-m-d');
        $referral_program_eligible_profile->save();


        /**
         * Add all the existing users to the current referral program
         */
        $today = \Carbon\Carbon::today();
        $data  = [];
        foreach (\App\UserProfile::all() as $userProfile) {
            $user   = $userProfile->user;
            $data[] = [
                'referral_program_id'   => 1,
                'user_id'               => $user->id,
                'starts_on'             => '2019-01-01',
                'created_at'            => $today->format('Y-m-d'),
                'updated_at'            => $today->format('Y-m-d'),
            ];
        }
        \App\ReferralProgramUser::insert($data);

        /*
         * Any New Non-MBA Users will Automatically See the Scholarship Pot
         */
    }
}
