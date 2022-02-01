<?php


namespace App\SkipPolicies;

use App\UserProfile;

class Always implements \App\Contracts\SkipPolicyInterface
{
    /**
     * @inheritDoc
     */
    public function check()
    {
        return true;
    }
}
