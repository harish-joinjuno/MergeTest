<?php


namespace App\Policies\Nova;


use App\ActionNotification;

class ActionNotificationPolicy extends AbstractNovaPermissionHandler
{
    public $resource = ActionNotification::class;
}
