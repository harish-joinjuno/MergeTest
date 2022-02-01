<?php

namespace App\Jobs;

use App\Facades\Twilio;
use App\SmsMessage;
use App\SmsMessageEvent;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTwilioMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $phoneNumber;

    public $message;

    public $user;

    /**
     * Create a new job instance.
     *
     * @param $phoneNumber
     * @param $message
     * @param User $user
     */
    public function __construct($phoneNumber, $message, User $user)
    {
        $this->phoneNumber = $phoneNumber;
        $this->message     = $message;
        $this->user        = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Twilio::sendSms($this->phoneNumber, [
            'body'            => $this->message,
            'status_callback' => twilioCallback(),
        ]);


        $smsMessage            = new SmsMessage();
        $smsMessage->user_id   = $this->user->id;
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
