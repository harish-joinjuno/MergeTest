<?php


namespace App\Jobs\CompleteFlow;


use App\AutoRefinanceApplication;

class MarkAutoLoanApplicationCompleted
{
    public function handle()
    {
        /** @var AutoRefinanceApplication $autoRefinanceApplication */
        $autoRefinanceApplication = user()->autoRefinanceApplications()->orderBy('id', 'desc')->first();

        if ($autoRefinanceApplication) {
            $autoRefinanceApplication->completed_application = true;
            $autoRefinanceApplication->save();
        }
    }
}
