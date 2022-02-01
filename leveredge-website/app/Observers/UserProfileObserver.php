<?php

namespace App\Observers;

use App\Jobs\UpdateSubscriberInMailchimp;
use App\Traits\HasChangesModel;
use App\UserProfile;

class UserProfileObserver
{
    use HasChangesModel;

    public function created(UserProfile $userProfile)
    {
    }

    public function updated(UserProfile $userProfile)
    {
        if ($this->hasChanges($userProfile) && UserProfile::SIGNUP_PROGRESS_COMPLETED == $userProfile->signup_progress) {
            // Update MailChimp with Subscriber Details
            dispatch(new UpdateSubscriberInMailchimp($userProfile->user));
        }
    }

    public function saved(UserProfile $userProfile)
    {
    }
}
