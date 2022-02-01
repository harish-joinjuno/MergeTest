<?php


namespace App\Policies\Nova;

use App\MarketingEmail;

class MarketingEmailPolicy extends AbstractNovaPermissionHandler
{
	public $resource = MarketingEmail::class;
}
