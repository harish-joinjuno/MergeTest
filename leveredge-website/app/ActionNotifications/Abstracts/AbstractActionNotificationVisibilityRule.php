<?php


namespace App\ActionNotifications\Abstracts;


use App\ActionNotification;
use App\User;

abstract class AbstractActionNotificationVisibilityRule
{
    public static $title;
    public static $description;
    abstract public static function passes(User $user, ActionNotification $actionNotification): bool;

    /**
     * @return mixed
     */
    public static function getTitle()
    {
        return self::$title;
    }

    /**
     * @return mixed
     */
    public static function getDescription()
    {
        return self::$description;
    }



}
