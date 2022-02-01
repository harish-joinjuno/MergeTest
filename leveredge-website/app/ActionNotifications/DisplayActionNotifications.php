<?php


namespace App\ActionNotifications;

use App\ActionNotification;
use Illuminate\Support\Facades\View;


class DisplayActionNotifications
{
    public static function all()
    {
        $actionNotifications = [];
        $user                = auth()->user();
        if ($user) {
            ActionNotification::all()->each(function ($actionNotification) use (&$actionNotifications, $user) {
                if ($actionNotification->isVisibleTo($user)) {
                    array_push($actionNotifications, $actionNotification);
                }
            });
        }

        View::share('action_notifications', $actionNotifications);
    }
}
