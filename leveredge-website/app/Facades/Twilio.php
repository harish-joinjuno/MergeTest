<?php

namespace App\Facades;

use App\Integrations\TwilioClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array sendSms(string $toPhoneNumber, array $data)
 * @method static array getPhoneNumber(string $webhookUrl)
 * @method static array updatePhoneNumberSmsWebhookUrl(string $webhookUrl)
 */
class Twilio extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TwilioClient::class;
    }
}
