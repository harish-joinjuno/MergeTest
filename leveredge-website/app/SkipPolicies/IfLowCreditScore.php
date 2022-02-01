<?php


namespace App\SkipPolicies;

use App\UserProfile;

class IfLowCreditScore implements \App\Contracts\SkipPolicyInterface
{
    /**
     * @inheritDoc
     */
    public function check()
    {
        $skippableCreditScores = [
            UserProfile::CREDIT_SCORE_BELOW_550,
            UserProfile::CREDIT_SCORE_BETWEEN_550_AND_649,
            UserProfile::CREDIT_SCORE_I_DONT_HAVE,
            UserProfile::CREDIT_SCORE_UNKNOWN,
        ];

        if ( in_array(user()->profile->credit_score,$skippableCreditScores) ) {
            return true;
        }

        return false;
    }
}
