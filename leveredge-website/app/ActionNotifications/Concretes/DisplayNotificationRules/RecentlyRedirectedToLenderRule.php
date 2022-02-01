<?php


namespace App\ActionNotifications\Concretes\DisplayNotificationRules;


use App\AccessTheDeal;
use App\ActionNotification;
use App\ActionNotifications\Abstracts\AbstractActionNotificationVisibilityRule;
use App\User;
use Carbon\Carbon;

class RecentlyRedirectedToLenderRule extends AbstractActionNotificationVisibilityRule
{

    public static $title = 'Recently Visited a LeverEdge Lender';

    public static $description = 'The user clicked on a link that took them to a LeverEdge lender in the last 14 days';

    public static function passes(User $user, ActionNotification $actionNotification): bool
    {
        return AccessTheDeal::where('user_id',$user->id)->where('created_at' , '>=' , Carbon::now()->subDays(14))->exists();
    }
}
