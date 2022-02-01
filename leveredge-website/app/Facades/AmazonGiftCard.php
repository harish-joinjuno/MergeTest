<?php


namespace App\Facades;


use App\Integrations\AmazonGiftCardClient;
use App\User;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array send(User $from, User $to, int $amount, string $description = null)
 */
class AmazonGiftCard extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AmazonGiftCardClient::class;
    }
}
