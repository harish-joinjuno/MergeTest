<?php


namespace App\ActionNotifications\Abstracts;


use App\ActionNotification;
use App\User;

abstract class AbstractDismissableRule
{
    public static $title;
    public static $description;
    abstract public static function passes(User $user, ActionNotification $actionNotification);
}
