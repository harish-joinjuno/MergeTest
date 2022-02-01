<?php


namespace App\Facades;


use App\Integrations\HubspotClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array setDealProperties($properties, $dealId)
 * @method static array countRegistrations($userProfiles)
 * @method static array countCompleteProfiles($userProfiles)
 * @method static array countClickedToProviders($userProfiles)
 * @method static array countCompleteProfilesHighQualities($userProfiles)
 * @method static array countReceivedQuotes($userProfiles)
 * @method static array countSignedLoans($userProfiles)
 */
class Hubspot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return HubspotClient::class;
    }
}
