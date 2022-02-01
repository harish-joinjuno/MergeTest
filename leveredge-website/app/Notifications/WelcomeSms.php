<?php

namespace App\Notifications;

use App\Channels\Messages\TwilioSmsMessage;
use App\Channels\SmsChannel;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class WelcomeSms extends Notification implements ShouldQueue
{
    use Queueable;

    public function via(User $notifiable)
    {
        return [SmsChannel::class];
    }

    public function toSms(User $notifiable)
    {
        $body = view('sms.welcome-user', ['user' => $notifiable])->render();
        return (new TwilioSmsMessage())
            ->to($notifiable->profile->phone_number)
            ->body($body);
    }
}
