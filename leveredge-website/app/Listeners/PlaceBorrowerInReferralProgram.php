<?php

namespace App\Listeners;

use App\Events\UserPlacedInReferralProgram;
use App\Events\UserProfileCompleted;
use App\Experiment;
use App\ReferralProgram;
use App\ReferralProgramEligibleProfile;
use App\ReferralProgramUser;
use App\User;
use Carbon\Carbon;

class PlaceBorrowerInReferralProgram
{
    public function handle(UserProfileCompleted $event)
    {
        /** @var User $user */
        $user        = $event->user;
        $userProfile = $user->profile;

        $referralPrograms = ReferralProgram::query()->orderBy('priority', 'asc')->get();

        if ($user->isPartOfExperiment(Experiment::find(Experiment::OPTION_TO_REGISTER_FOR_REFERRAL_PROGRAM_ONLY))) {
            $referralProgramUser                      = new ReferralProgramUser();
            $referralProgramUser->user_id             = $user->id;
            $referralProgramUser->referral_program_id = ReferralProgram::where('slug',ReferralProgram::REFERRAL_PROGRAM_TWO_HUNDRED_PER_LOAN_ABOVE_20K)->first()->id;
            $referralProgramUser->starts_on           = Carbon::today()->format('Y-m-d');
            $referralProgramUser->save();

            return;
        }

        /** @var ReferralProgram $referralProgram */
        foreach ($referralPrograms as $referralProgram) {
            /** @var ReferralProgramEligibleProfile $referralProgramEligibleProfile */
            foreach ($referralProgram->referralProgramEligibleProfiles as $referralProgramEligibleProfile) {
                if (!$referralProgramEligibleProfile->matches($userProfile)) {
                    continue;
                }

                $referralProgramUser                      = new ReferralProgramUser();
                $referralProgramUser->user_id             = $user->id;
                $referralProgramUser->referral_program_id = $referralProgram->id;
                $referralProgramUser->starts_on           = Carbon::today()->format('Y-m-d');
                $referralProgramUser->save();

                event(new UserPlacedInReferralProgram($user));

                return;
            }
        }
    }
}
