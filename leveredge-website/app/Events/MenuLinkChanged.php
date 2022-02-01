<?php

namespace App\Events;

use App\MenuLink;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MenuLinkChanged
{
    use Dispatchable, SerializesModels;

    public $menuLink;

    public function __construct(MenuLink $menuLink)
    {
        $this->menuLink = $menuLink;
    }
}
