<?php


namespace App\Facades;


use App\Integrations\CheckbookIoClient;
use App\User;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array send(User $from, User $to, int $amount, string $description = null)
 */
class CheckBookIo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CheckbookIoClient::class;
    }
}
