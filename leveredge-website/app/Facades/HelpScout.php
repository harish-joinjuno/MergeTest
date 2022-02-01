<?php


namespace App\Facades;


use App\Integrations\HelpScoutClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array createConversation($email, $message)
 */
class HelpScout extends Facade
{
    protected static function getFacadeAccessor()
    {
        return HelpScoutClient::class;
    }
}
