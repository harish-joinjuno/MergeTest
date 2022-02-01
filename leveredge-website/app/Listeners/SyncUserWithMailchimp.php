<?php

namespace App\Listeners;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncUserWithMailchimp implements ShouldQueue
{
    public function handle($event)
    {
        /** @var User $user */
        $user = $event->user;
        $user->profile->syncWithMailchimp();
    }
}
