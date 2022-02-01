<?php


namespace App\SkipPolicies;

class IfSignedIn implements \App\Contracts\SkipPolicyInterface
{
    /**
     * @inheritDoc
     */
    public function check()
    {
        if ( auth()->check() ) {
            return true;
        }

        return false;
    }
}
