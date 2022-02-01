<?php


namespace App\Redirects;


use App\Contracts\Redirects\RedirectsInterface;
use App\UserProfile;

class RedirectToRefinanceEndScreen implements RedirectsInterface
{

    public function url(): string
    {
        $userProfile = userProfile();

        if (! $userProfile->is_currently_employed && $userProfile->immigration_status !== UserProfile::IMMIGRATION_STATUS_OTHER) {
            return '/user-profile/refinance/end';
        }

        return '/user-profile/end';
    }
}
