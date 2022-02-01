<?php

namespace App\Channels;

use App\Facades\Twilio;
use App\SmsMessage;
use App\SmsMessageEvent;
use App\User;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send(User $user, Notification $notification)
    {
        $message = $notification->toSms($user);

        $response = Twilio::sendSms($message->to, [
            'body'            => $message->body,
            'status_callback' => twilioCallback(),
        ]);

        $smsMessage            = new SmsMessage();
        $smsMessage->user_id   = $user->id;
        $smsMessage->incoming  = false;
        $smsMessage->twilio_id = $response['id'];
        $smsMessage->from      = $response['from'];
        $smsMessage->to        = $response['to'];
        $smsMessage->body      = $response['body'];
        $smsMessage->media     = [];
        $smsMessage->status    = SmsMessageEvent::STATUS_DELIVERED;
        $smsMessage->save();
    }
}
