<?php

namespace App\Jobs;

use App\Events\SmsReceived;
use App\SmsMessage;
use App\SmsMessageEvent;
use App\UserProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class TwilioWebhookHandler implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $data = $this->data;

        if (app()->environment('local')) {
            Storage::disk()->put('/integrations/twilio/incoming/' . microtime() . '.json', json_encode($data));
        }

        if (isset($data['MessageStatus'])) {
            $this->handleEvent($data);

            return;
        }

        $this->handleIncomingMessage($data);
    }

    private function handleEvent($data)
    {
        /** @var SmsMessage $smsMessage */
        $smsMessage = SmsMessage::query()
            ->where('twilio_id', '=', $data['SmsSid'])
            ->first();

        if (!$smsMessage) {
            return;
        }

        if ($smsMessage->status != SmsMessageEvent::STATUS_DELIVERED) {
            $smsMessage->status = $data['SmsStatus'];
            $smsMessage->save();
        }

        SmsMessageEvent::unguard();
        $smsMessage->events()
            ->create([
                'status'    => $data['SmsStatus'],
                'twilio_id' => $data['SmsSid'],
            ]);
    }

    private function handleIncomingMessage($data)
    {
        if (!$this->valid($data)) {
            return;
        }

        if (config('services.twilio.phone_number') != $data['To']) {
            return;
        }

        /** @var UserProfile $userProfile */
        $userProfile = UserProfile::query()
            ->where('phone_number', '=', $data['From'])
            ->first();

        $media = [];
        for ($i = 0; $i < $data['NumMedia']; $i++) {
            if (!isset($data['MediaUrl' . $i])) {
                continue;
            }
            $media[] = [
                'url'          => $data['MediaUrl' . $i],
                'content_type' => $data['MediaContentType' . $i],
            ];
        }

        $smsMessage            = new SmsMessage();
        $smsMessage->user_id   = optional($userProfile)->user_id;
        $smsMessage->incoming  = true;
        $smsMessage->twilio_id = $data['SmsSid'];
        $smsMessage->from      = $data['From'];
        $smsMessage->to        = $data['To'];
        $smsMessage->body      = $data['Body'];
        $smsMessage->media     = $media;
        $smsMessage->status    = SmsMessageEvent::STATUS_DELIVERED;
        $smsMessage->save();
    }

    private function valid(array $data)
    {
        $requiredKeys = [
            'SmsSid',
            'From',
            'To',
            'FromCountry',
            'ToCountry',
            'Body',
            'NumMedia',
        ];

        foreach ($requiredKeys as $field) {
            if (!array_key_exists($field, $data)) {
                return false;
            }
        }

        return true;
    }
}
