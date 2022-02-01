<?php


namespace App\Integrations;

use HelpScout\Api\ApiClientFactory;
use HelpScout\Api\Conversations\Conversation;
use HelpScout\Api\Conversations\Threads\CustomerThread;
use HelpScout\Api\Customers\Customer;
use HelpScout\Api\Customers\CustomerFilters;
use HelpScout\Api\Entity\Collection;
use HelpScout\Api\Exception\ValidationErrorException;
use HelpScout\Api\Users\UserFilters;

class HelpScoutClient
{
    private $client;

    private $appId;

    private $appSecret;

    private $mailboxId;

    public function __construct()
    {
        $credentials     = config('services.helpscout');
        $this->appId     = $credentials['app_id'];
        $this->appSecret = $credentials['app_secret'];
        $this->mailboxId = (int)$credentials['mailbox_id'];
        $this->client    = ApiClientFactory::createClient();
        $this->client->useClientCredentials($credentials['app_id'], $credentials['app_secret']);
    }

    public function createConversation($email, $message)
    {

        $customer = new Customer();
        $customer->addEmail($email);
        $thread = new CustomerThread();
        $thread->setCustomer($customer);
        $thread->setText($message);

        $conversation = new Conversation();
        $conversation->setSubject('Help&Support');
        $conversation->setStatus('active');
        $conversation->setType('email');
        $conversation->setMailboxId($this->mailboxId);
        $conversation->setCustomer($customer);
        $conversation->setThreads(new Collection([
            $thread,
        ]));

        try {
            $conversationId = $this->client->conversations()->create($conversation);
        } catch (ValidationErrorException $e) {
            dd($e->getError()->getErrors(), $e->getCode());
        }
    }
}
