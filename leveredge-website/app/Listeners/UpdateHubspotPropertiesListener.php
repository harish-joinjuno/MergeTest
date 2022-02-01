<?php

namespace App\Listeners;

use App\Jobs\UpdateHubSpotProperties;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateHubspotPropertiesListener implements ShouldQueue
{
    public function handle($event)
    {
        $userProfile = $event->user->profile;

        $utmProp = [
            'utm_source'   => $userProfile->utm_source,
            'utm_medium'   => $userProfile->utm_medium,
            'utm_campaign' => $userProfile->utm_campaign,
            'utm_term'     => $userProfile->utm_term,
            'utm_content'  => $userProfile->utm_content,
        ];

        dispatch(new UpdateHubSpotProperties($utmProp));
    }
}
