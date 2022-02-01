<?php

namespace App\Providers\App\Listeners;

use App\Events\UserPlacedInNegotiationGroup;
use App\Events\UserProfileUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReassessBorrowerNegotiationGroup
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserProfileUpdated  $event
     * @return void
     */
    public function handle(UserProfileUpdated $event)
    {
        foreach ($event->user->negotiationGroupUsers as $negotiationGroupUser) {
            if ($negotiationGroupUser->academicYear) {
                $event->user->profile->placeInEligibleNegotiationGroups($negotiationGroupUser->academicYear);
                event(new UserPlacedInNegotiationGroup($event->user));
            }
        }
    }
}
