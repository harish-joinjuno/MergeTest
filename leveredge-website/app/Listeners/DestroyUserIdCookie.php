<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Cookie;

class DestroyUserIdCookie
{
    public function handle(Logout $event)
    {
        Cookie::queue(Cookie::forget('leveredge_user_id'));
    }
}
