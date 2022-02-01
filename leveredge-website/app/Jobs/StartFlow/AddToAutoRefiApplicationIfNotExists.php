<?php


namespace App\Jobs\StartFlow;

use App\AutoRefinanceApplication;
use App\Traits\ManagesExperimentParticipation;

class AddToAutoRefiApplicationIfNotExists
{
    use ManagesExperimentParticipation;

    public function handle()
    {
        if (auth()->check()) {
            $autoRefiApplication = user()->autoRefinanceApplications()->orderBy('id','desc')->first();

            if (! $autoRefiApplication) {
                AutoRefinanceApplication::firstOrCreate([
                    'client_id' => getClientId(),
                    'user_id'   => user()->id,
                ]);
            }
        }
    }
}
