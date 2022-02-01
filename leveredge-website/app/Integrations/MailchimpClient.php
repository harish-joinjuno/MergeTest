<?php

namespace App\Integrations;

use App\Exceptions\MailchimpAutomatedCampaignException;
use DrewM\MailChimp\Batch;
use DrewM\MailChimp\MailChimp;
use Illuminate\Support\Facades\Validator;

class MailchimpClient
{
    const STATUS_ACTIVE       = 'active';
    const STATUS_INACTIVE     = 'inactive';
    const STATUS_SUBSCRIBED   = 'subscribed';
    const STATUS_UNSUBSCRIBED = 'unsubscribed';

    private $client;

    private $defaultListId;

    private $gmassListId;

    private $removableTags = [];

    public function __construct($mailChimp = null)
    {
        $apiKey              = config('services.mailchimp.api_key');
        $this->defaultListId = config('services.mailchimp.default_list_id');
        $this->gmassListId   = config('services.mailchimp.gmass_list_id');

        if ($apiKey && !$mailChimp) {
            $mailChimp = new MailChimp($apiKey);
        }

        $this->client = $mailChimp;
    }

    public function getAllLists()
    {
        return $this->client->get('lists');
    }

    public function findSubscriber(string $email, string $listId = null)
    {
        if ($listId == null) {
            $listId = $this->defaultListId;
        }

        $subscriberHash = $this->client->subscriberHash($email);

        $endpoint = "lists/{$listId}/members/{$subscriberHash}";

        $result = $this->client->get($endpoint);

        if (!$this->client->success()) {
            return null;
        }

        return $result;
    }

    public function subscribeBatch(string $email, Batch &$batch, $batchOp, array $data = [], array $tags = [])
    {
        $validated = Validator::make($data, [
            'FNAME'      => ['nullable', 'max:128'],
            'TYPE'       => ['nullable'],
            'CODE'       => ['nullable'],
            'UNI'        => ['nullable'],
            'DEGREE'     => ['nullable'],
            'GRADYEAR'   => ['nullable', 'integer'],
            'REFERREDBY' => ['nullable'],
            'G_UNI'      => ['nullable'],
            'G_DEGREE'   => ['nullable'],
            'G_GRADYEAR' => ['nullable', 'integer'],
        ])->validate();

        $data = [
            'email_address' => $email,
        ];

        $subscriberHash = $this->client->subscriberHash($email);
        $endpoint       = "lists/{$this->defaultListId}/members/{$subscriberHash}";

        if ($validated) {
            $data['merge_fields'] = $validated;
        }

        $batch->put($batchOp, $endpoint, $data);

        $tags = array_map(function ($tag) {
            return ['name' => $tag, 'status' => self::STATUS_ACTIVE];
        }, $tags);

        $this->addTagsBatch($email, $tags, $batch, $batchOp);
    }

    public function subscribe(string $email, array $data = [], array $tags = [])
    {
        $validated = Validator::make($data, [
            'FNAME'      => ['nullable', 'max:128'],
            'TYPE'       => ['nullable'],
            'CODE'       => ['nullable'],
            'UNI'        => ['nullable'],
            'DEGREE'     => ['nullable'],
            'GRADYEAR'   => ['nullable', 'integer'],
            'REFERREDBY' => ['nullable'],
            'G_UNI'      => ['nullable'],
            'G_DEGREE'   => ['nullable'],
            'G_GRADYEAR' => ['nullable', 'integer'],
        ])->validate();

        $subscriber = $this->findSubscriber($email);

        if ($subscriber) {
            return $this->syncSubscriber($email, $data, $tags);
        }

        $body = [
            'email_address' => $email,
            'status'        => self::STATUS_SUBSCRIBED,
            'tags'          => $tags,
        ];

        if ($validated) {
            $body['merge_fields'] = $validated;
        }

        $subscriberHash = $this->client->subscriberHash($email);
        $endpoint       = "lists/{$this->defaultListId}/members/{$subscriberHash}";

        return $this->client->put($endpoint, $body);
    }

    public function syncSubscriber(string $email, array $data, array $tags)
    {
        $validated = Validator::make($data, [
            'FNAME'      => ['nullable', 'max:128'],
            'TYPE'       => ['nullable'],
            'CODE'       => ['nullable'],
            'UNI'        => ['nullable'],
            'DEGREE'     => ['nullable'],
            'GRADYEAR'   => ['nullable', 'integer'],
            'REFERREDBY' => ['nullable'],
            'G_UNI'      => ['nullable'],
            'G_DEGREE'   => ['nullable'],
            'G_GRADYEAR' => ['nullable', 'integer'],
        ])->validate();

        $subscriber = $this->findSubscriber($email);

        if (!$subscriber) {
            return $this->subscribe($email, $data, $tags);
        }

        $body = [
            'email_address' => $email,
            'status'        => self::STATUS_SUBSCRIBED,
        ];

        if ($validated) {
            $body['merge_fields'] = $validated;
        }

        $subscriberHash = $this->client->subscriberHash($email);
        $endpoint       = "lists/{$this->defaultListId}/members/{$subscriberHash}";

        $this->addTags($email, $this->syncTags($email, $tags));

        $response = $this->client->put($endpoint, $body);

        return $response;
    }

    public function unsubscribe(string $email, string $listId)
    {

        if (!trim($listId)) {
            return null;
        }

        $subscriber = $this->findSubscriber($email, $listId);

        if (!$subscriber) {
            return null;
        }

        $body = [
            'email_address' => $email,
            'status'        => self::STATUS_UNSUBSCRIBED,
        ];

        $subscriberHash = $this->client->subscriberHash($email);
        $endpoint       = "lists/{$listId}/members/{$subscriberHash}";

        return $this->client->patch($endpoint, $body);
    }

    public function unsubscribeBatch(string $email, string $listId, Batch &$batch, $batchOp)
    {
        if (! trim($listId)) {
            return null;
        }

        $data = [
            'status' => self::STATUS_UNSUBSCRIBED,
        ];

        $subscriberHash = $this->client->subscriberHash($email);
        $endpoint       = "lists/{$listId}/members/{$subscriberHash}";

        $batch->patch($batchOp, $endpoint, $data);
    }

    public function addTags(string $email, array $tags, bool $synced = false)
    {
        $subscriberHash = $this->client->subscriberHash($email);

        $endpoint = "lists/{$this->defaultListId}/members/{$subscriberHash}/tags";

        if ($synced) {
            $tags = $this->syncTags($email, array_column($tags, 'name'));
        }

        return $this->client->post($endpoint, compact('tags'));
    }

    public function addTagsBatch(string $email, array $tags, Batch &$batch, $batchOp): void
    {
        $subscriberHash = $this->client->subscriberHash($email);

        $endpoint = "lists/{$this->defaultListId}/members/{$subscriberHash}/tags";

        $batch->post("tags-{$batchOp}", $endpoint, compact('tags'));
    }

    public function getTags(string $email)
    {
        $subscriberHash = $this->client->subscriberHash($email);

        $endpoint = "lists/{$this->defaultListId}/members/{$subscriberHash}/tags?count=1000";

        return $this->client->get($endpoint);
    }

    public function syncTags(string $email, array $tags)
    {
        $syncedTags = [];

        $regex = config('services.mailchimp.removable_tags_regex');

        if ($regex) {
            $getTags = $this->getTags($email);
            $getTags = array_column($getTags['tags'], 'name');

            $getTags = array_filter($getTags, function ($tag) use ($regex) {
                return preg_match("/{$regex}/i", $tag);
            });

            array_walk($getTags, function ($tag) use (&$syncedTags) {
                $syncedTags[$tag] = ['name' => $tag, 'status' => self::STATUS_INACTIVE];
            });
        }

        array_walk($tags, function ($tag) use (&$syncedTags) {
            $syncedTags[$tag] = ['name' => $tag, 'status' => self::STATUS_ACTIVE];
        });

        return array_values($syncedTags);
    }

    public function newBatch($id = null)
    {
        return $this->client->new_batch($id);
    }

    public function setDefaultListId(string $defaultListId = null)
    {
        $this->defaultListId = $defaultListId ?? config('services.mailchimp.list_id');

        return $this;
    }

    public function setRemovableTags(array $removableTags = [])
    {
        $this->removableTags = $removableTags;

        return $this;
    }

    public function triggerEmail(string $endPoint, string $email)
    {
        $this->client
            ->post($endPoint,[
                'email_address' => $email,
            ]);
    }

    public function allSegments()
    {
        $endpoint = "lists/{$this->defaultListId}/segments?count=1000";

        return $this->client->get($endpoint);
    }

    public function addNewSegment($tag)
    {
        $endpoint = "lists/{$this->defaultListId}/segments";

        $data = [
            'name'           => $tag,
            'static_segment' => [],
        ];

        return $this->client->post($endpoint, $data);
    }

    public function addMemberToSegment($emails, $segmentId)
    {
        $endpoint = "/lists/{$this->defaultListId}/segments/{$segmentId}";

        return $this->client->post($endpoint, [
            'members_to_add' => $emails,
        ], 30);
    }

    public function deleteSegment($segmentId)
    {
        $endpoint = "/lists/{$this->defaultListId}/segments/{$segmentId}";

        return $this->client->delete($endpoint);
    }

    public function addMembersToAutomationCampaignQueue(string $endpoint, string $email)
    {
        $response = $this->client->post($endpoint, [
            'email_address' => $email,
        ]);

        if (! $response || (is_array($response) && isset($response['type']))) {
            $error = "Not Available";
            if (is_array($response)) {
                $error = (string)json_encode($response);
            }
            $message = "Mailchimp automated campaign queue failed for - [{$endpoint}] - for email - [{$email}]. Error Is - {$error}";
            throw (new MailchimpAutomatedCampaignException($message))->setError($error);
        }
    }
}
