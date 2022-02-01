<?php


namespace App\Policies\Nova;


use App\MagicLoginLink;

class MagicLoginLinkPolicy extends AbstractNovaPermissionHandler
{
    public $resource = MagicLoginLink::class;
}
