<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cookie;

class SetUserIdCookie
{
    public function handle(Login $event)
    {
        Cookie::queue('leveredge_user_id', $event->user->id);
    }
}
