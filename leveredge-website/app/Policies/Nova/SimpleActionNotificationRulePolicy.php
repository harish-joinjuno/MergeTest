<?php


namespace App\Policies\Nova;


use App\SimpleActionNotificationRule;

class SimpleActionNotificationRulePolicy extends AbstractNovaPermissionHandler
{
    public $resource = SimpleActionNotificationRule::class;
}
