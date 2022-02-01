<?php


namespace App\Policies\Nova;


use App\MenuLink;

class MenuLinkPolicy extends AbstractNovaPermissionHandler
{
    public $resource = MenuLink::class;
}
