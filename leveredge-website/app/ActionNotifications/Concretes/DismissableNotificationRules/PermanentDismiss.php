<?php


namespace App\ActionNotifications\Concretes\DismissableNotificationRules;


use App\ActionNotification;
use App\ActionNotifications\Abstracts\AbstractDismissableRule;
use App\DismissedActionNotification;
use App\User;

class PermanentDismiss extends AbstractDismissableRule
{

    public static $title = 'Permanently disable notification';

    public static $description = 'Disable notification permanently with no re-show option';

    public static function passes(User $user, ActionNotification $actionNotification)
    {
        return ! DismissedActionNotification::whereUserId($user->id)
            ->whereActionNotificationId($actionNotification->id)
            ->exists();
    }
}
