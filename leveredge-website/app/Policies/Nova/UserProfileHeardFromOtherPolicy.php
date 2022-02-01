<?php


namespace App\Policies\Nova;


use App\UserProfileHeardFromOther;

class UserProfileHeardFromOtherPolicy extends AbstractNovaPermissionHandler
{
    public $resource = UserProfileHeardFromOther::class;
}
