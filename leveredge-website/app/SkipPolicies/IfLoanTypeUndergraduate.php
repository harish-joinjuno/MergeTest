<?php


namespace App\SkipPolicies;

use App\UserProfile;

class IfLoanTypeUndergraduate implements \App\Contracts\SkipPolicyInterface
{
    /**
     * @inheritDoc
     */
    public function check()
    {
        $clientResponder = getClient()->questionResponder()->whereIn('question_id', [1,61])->orderByDesc('created_at')->first();
        $loanType        = user() ? user()->profile->loan_type : $clientResponder->response;
        if ( strcasecmp($loanType,"Undergraduate")  == 0 ) {
            return true;
        }

        return false;
    }
}
