<?php

namespace App\Listeners;

use App\Events\UserProfileCompleted;
use App\Mail\UserCreatedNotification;
use App\Notifications\WelcomeSms;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandlePhoneNumberAfterProfileCompleted implements ShouldQueue
{
    public function handle(UserProfileCompleted $event)
    {
        /** @var User $user */
        $user        = $event->user;
        $userProfile = $user->profile;

        if (!$userProfile->phone_number) {
            return;
        }

        Mail::to(['nikhil@leveredge.org', 'chris@leveredge.org'])
            ->send(new UserCreatedNotification($event->user));

//        Temporary disable welcome sms sending
//        if( substr($userProfile->phone_number,0,2) == "+1" ){
//            $user->notify(new WelcomeSms());
//        }
    }
}
