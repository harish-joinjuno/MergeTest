<?php

namespace App\Observers;

use App\Events\UserProfileUpdated;
use App\NegotiationGroupUserExclusion;

class NegotiationGroupUserExclusionObserver
{
    /**
     * Handle the negotiation group user exclusion "created" event.
     *
     * @param  \App\NegotiationGroupUserExclusion  $negotiationGroupUserExclusion
     * @return void
     */
    public function created(NegotiationGroupUserExclusion $negotiationGroupUserExclusion)
    {
        event(new UserProfileUpdated( $negotiationGroupUserExclusion->user ));
    }

    /**
     * Handle the negotiation group user exclusion "updated" event.
     *
     * @param  \App\NegotiationGroupUserExclusion  $negotiationGroupUserExclusion
     * @return void
     */
    public function updated(NegotiationGroupUserExclusion $negotiationGroupUserExclusion)
    {
        event(new UserProfileUpdated( $negotiationGroupUserExclusion->user ));
    }

    /**
     * Handle the negotiation group user exclusion "deleted" event.
     *
     * @param  \App\NegotiationGroupUserExclusion  $negotiationGroupUserExclusion
     * @return void
     */
    public function deleted(NegotiationGroupUserExclusion $negotiationGroupUserExclusion)
    {
        event(new UserProfileUpdated( $negotiationGroupUserExclusion->user ));
    }

    /**
     * Handle the negotiation group user exclusion "restored" event.
     *
     * @param  \App\NegotiationGroupUserExclusion  $negotiationGroupUserExclusion
     * @return void
     */
    public function restored(NegotiationGroupUserExclusion $negotiationGroupUserExclusion)
    {
        event(new UserProfileUpdated( $negotiationGroupUserExclusion->user ));
    }

    /**
     * Handle the negotiation group user exclusion "force deleted" event.
     *
     * @param  \App\NegotiationGroupUserExclusion  $negotiationGroupUserExclusion
     * @return void
     */
    public function forceDeleted(NegotiationGroupUserExclusion $negotiationGroupUserExclusion)
    {
        event(new UserProfileUpdated( $negotiationGroupUserExclusion->user ));
    }
}
