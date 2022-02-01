<?php


namespace App\Policies\Nova;

use App\MarketingEmailUnsubscribe;

class MarketingEmailUnsubscribePolicy extends AbstractNovaPermissionHandler
{
	public $resource = MarketingEmailUnsubscribe::class;
}
