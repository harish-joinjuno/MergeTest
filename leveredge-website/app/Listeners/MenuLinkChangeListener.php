<?php

namespace App\Listeners;

use App\Events\MenuLinkChanged;
use Illuminate\Support\Facades\Cache;

class MenuLinkChangeListener
{
    public function handle(MenuLinkChanged $event)
    {
        Cache::forget('menuLinks:' . $event->menuLink->menu);
    }
}
