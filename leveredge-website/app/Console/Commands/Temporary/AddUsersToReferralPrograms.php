<?php

namespace App\Console\Commands\Temporary;

use App\Events\UserPlacedInReferralProgram;
use App\Experiment;
use App\ReferralProgram;
use App\ReferralProgramEligibleProfile;
use App\ReferralProgramUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddUsersToReferralPrograms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:set-referral-program';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::whereDoesntHave('referralProgramUsers')->whereHas('profile')->count();
        
        $progressBar = $this->output->createProgressBar($users);
        User::whereDoesntHave('referralProgramUsers')
            ->whereHas('profile')
            ->orderBy('id')
            ->chunk(100, function ($users) use ($progressBar) {
                $users->each(function (User $user) use ($progressBar) {
                    $referralPrograms = ReferralProgram::query()->orderBy('priority', 'asc')->get();
                    $userProfile = $user->profile;
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
                });

                $progressBar->advance(100);
            });

        $progressBar->finish();
    }
}
