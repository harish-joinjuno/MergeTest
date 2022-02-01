<?php


namespace Tests\Builders;

use App\ActionNotification;
use App\Deal;
use App\DealStatus;
use App\DealStatusApplicability;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;


/**
 * @property int    $sort_order
 *
 */

class ActionNotificationBuilder
{
    use WithFaker;

    /** @var ActionNotification */
    public $actionNotification;

    public function __construct($attributes = [])
    {
        $this->faker                    = $this->makeFaker('en_US');
        $this->actionNotification       = factory(ActionNotification::class)->make($attributes);
    }

    public function save()
    {
        $this->actionNotification->save();
        return $this;
    }

    public function get()
    {
        return $this->actionNotification;
    }


    public function withTitle(string $title = null)
    {
        if (!$title) {
            $title = 'Random Title';
        }

        $this->actionNotification->title = $title;
        return $this;
    }

    public function withDescription(string $description = null)
    {
        if (!$description) {
            $description = 'Random Description';
        }

        $this->actionNotification->description = $description;
        return $this;
    }

    public function withCtaText(string $cta_text = null)
    {
        if (!$cta_text) {
            $cta_text = 'Call to Action';
        }

        $this->actionNotification->cta_text = $cta_text;
        return $this;
    }

    public function withCtaLink(string $link = null)
    {
        if (!$link) {
            $link = '/';
        }

        $this->actionNotification->cta_link = $link;
        return $this;
    }

    public function withIcon(string $icon_classes = null)
    {
        if (!$icon_classes) {
            $icon_classes = 'far fa-flag-alt';
        }

        $this->actionNotification->icon = $icon_classes;
        return $this;
    }

    public function withNotificationStyle(string $notification_style = null){
        if(!$notification_style){
            $notification_style = 'success';
        }

        $this->actionNotification->notification_style = $notification_style;
        return $this;
    }

    public function withVisibilityRule(string $visibility_rule = null){
           if(!$visibility_rule){
               $visibility_rule = 'App\ActionNotifications\Concretes\DismissableNotificationRules\PermanentDismiss';
           }

           $this->actionNotification->visibility_rule = $visibility_rule;
           return $this;
    }

    public function withDismissableRule(string $dismissable_rule = null){
        if(!$dismissable_rule){
            $dismissable_rule = 'App\ActionNotifications\Concretes\DisplayNotificationRules\ActionNotificationsRuleTable';
        }

        $this->actionNotification->dismissable_rule = $dismissable_rule;
        return $this;
    }


}
