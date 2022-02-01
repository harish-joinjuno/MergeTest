<?php


namespace App\SkipPolicies;

use App\QuestionResponder;
use App\UserProfile;

class IfLoanTypeGraduate implements \App\Contracts\SkipPolicyInterface
{
    /**
     * @inheritDoc
     */
    public function check()
    {
        $clientResponder = getClient()->questionResponder()->whereIn('question_id', [1,61])->orderByDesc('created_at')->first();
        $loanType        = user() ? user()->profile->loan_type : $clientResponder->response;
        if ( strcasecmp($loanType,"Graduate")  == 0 ) {
            return true;
        }

        return false;
    }
}
