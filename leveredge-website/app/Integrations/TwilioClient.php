<?php


namespace App\Integrations;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class TwilioClient
{

    private $client;

    public function __construct($client = null)
    {
        if (!$client) {
            $sid    = config('services.twilio.sid');
            $token  = config('services.twilio.token');
            $client = new Client($sid, $token);
        }

        $this->client = $client;
    }

    public function sendSms(string $toPhoneNumber, array $data)
    {
        $validated = Validator::make($data, [
            'body'            => ['required'],
            'status_callback' => ['required', 'url'],
            'media_url'       => ['nullable', 'url'],
        ])->validate();

        $payload = [
            'from'           => config('services.twilio.phone_number'),
            'body'           => $validated['body'],
            'statusCallback' => $validated['status_callback'],
        ];

        if (isset($validated['media_url'])) {
            $payload['mediaUrl'] = $validated['media_url'];
        }

        $response = $this->client->messages->create($toPhoneNumber, $payload);
        $value    = $response->toArray();

        if (app()->environment('local')) {
            Storage::disk()->put('/integrations/twilio/outgoing/' . microtime() . '.json', json_encode($value));
        }

        return [
            'id'         => $value['sid'],
            'account_id' => $value['accountSid'],
            'from'       => $value['from'],
            'to'         => $value['to'],
            'body'       => $value['body'],
        ];
    }

    public function getPhoneNumber()
    {
        $phoneNumberSid = config('services.twilio.phone_number_sid');

        $incomingPhoneNumber = $this
            ->client
            ->incomingPhoneNumbers($phoneNumberSid)
            ->fetch();

        $value = $incomingPhoneNumber->toArray();

        return [
            'id'              => $value['sid'],
            'phone_number'    => $value['phoneNumber'],
            'friendly_name'   => $value['friendlyName'],
            'sms_webhook_url' => $value['smsUrl'],
        ];
    }

    public function updatePhoneNumberSmsWebhookUrl(string $webhookUrl)
    {
        $phoneNumberSid = config('services.twilio.phone_number_sid');

        $incomingPhoneNumber = $this
            ->client
            ->incomingPhoneNumbers($phoneNumberSid)
            ->update([
                'smsUrl' => $webhookUrl,
            ]);

        $value = $incomingPhoneNumber->toArray();

        return [
            'id'              => $value['sid'],
            'phone_number'    => $value['phoneNumber'],
            'friendly_name'   => $value['friendlyName'],
            'sms_webhook_url' => $value['smsUrl'],
        ];
    }
}
