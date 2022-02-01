<?php

namespace App\Jobs;

use App\Facades\Hubspot;
use App\TrackedLink;
use App\UserProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class UpdateHubSpotProperties implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $utmProp;

    public function __construct(array $utmProp)
    {
        $this->utmProp = $utmProp;
    }

    public function handle()
    {
        $utmProp = $this->utmProp;

        Redis::throttle('hubspot-api')
            ->allow(100)
            ->every(10)
            ->then(function () use ($utmProp) {
                $trackedLink = TrackedLink::whereUtmSource($utmProp['utm_source'])
                    ->whereUtmMedium($utmProp['utm_medium'])
                    ->whereUtmCampaign($utmProp['utm_campaign'])
                    ->whereUtmTerm($utmProp['utm_term'])
                    ->whereUtmContent($utmProp['utm_content'])
                    ->first();

                if (is_object($trackedLink) && ! empty($trackedLink->hubspot_deal_id)) {
                    $userProfiles = UserProfile::whereUtmSource($utmProp['utm_source'])
                        ->whereUtmMedium($utmProp['utm_medium'])
                        ->whereUtmCampaign($utmProp['utm_campaign'])
                        ->whereUtmTerm($utmProp['utm_term'])
                        ->whereUtmContent($utmProp['utm_content'])
                        ->get();

                    $properties = [
                        'registrations'                  => Hubspot::countRegistrations($userProfiles),
                        'complete_profiles'              => Hubspot::countCompleteProfiles($userProfiles),
                        'complete_profiles_high_quality' => Hubspot::countCompleteProfilesHighQualities($userProfiles),
                        'clicked_to_provider'            => Hubspot::countClickedToProviders($userProfiles),
                        'received_quotes'                => Hubspot::countReceivedQuotes($userProfiles),
                        'signed_loan'                    => Hubspot::countSignedLoans($userProfiles),
                    ];

                    Hubspot::setDealProperties($properties, $trackedLink->hubspot_deal_id);
                }
            });
    }
}
