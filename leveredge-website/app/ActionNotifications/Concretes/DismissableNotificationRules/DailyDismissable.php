<?php


namespace App\ActionNotifications\Concretes\DismissableNotificationRules;


use App\ActionNotification;
use App\ActionNotifications\Abstracts\AbstractDismissableRule;
use App\DismissedActionNotification;
use App\User;
use Carbon\Carbon;

class DailyDismissable extends AbstractDismissableRule
{
    public static $title = 'Daily Dismissable';

    public static $description = 'Dismissable Notification which would re-appear after 24 hours';

    public static function passes(User $user, ActionNotification $actionNotification)
    {
        $lastDismissed = DismissedActionNotification::whereUserId($user->id)
                            ->whereActionNotificationId($actionNotification->id)
                            ->orderBy('created_at', 'DESC')
                            ->first();
        if (is_object($lastDismissed) && $lastDismissed->exists()) {
            return Carbon::now()->diffInDays($lastDismissed->dismissed_at) >= 1;
        }

        return true;
    }
}
