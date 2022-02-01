<?php


namespace App\Facades;


use App\Integrations\MailchimpClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array subscribe(string $email, array $data = [], array $tags = [])
 * @method static array syncSubscriber(string $email, array $data, array $tags)
 * @method static array unsubscribe(string $email, string $listId)
 * @method static array addTags(string $email, array $tags, bool $synced = false)
 * @method static array triggerEmail(string $endPoint, string $email)
 * @method static array addMembersToAutomationCampaignQueue(string $endpoint, string $email)
 */
class Mailchimp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MailchimpClient::class;
    }
}
