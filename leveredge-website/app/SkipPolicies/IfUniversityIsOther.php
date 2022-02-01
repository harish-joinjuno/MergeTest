<?php


namespace App\SkipPolicies;


use App\University;

class IfUniversityIsOther implements \App\Contracts\SkipPolicyInterface
{

    public function check()
    {
        return user()->profile->university_id === University::OTHER;
    }
}
