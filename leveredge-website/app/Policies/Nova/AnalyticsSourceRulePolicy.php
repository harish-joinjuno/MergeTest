<?php


namespace App\Policies\Nova;

use App\AnalyticsSourceRule;

class AnalyticsSourceRulePolicy extends AbstractNovaPermissionHandler
{
    public $resource = AnalyticsSourceRule::class;
}
