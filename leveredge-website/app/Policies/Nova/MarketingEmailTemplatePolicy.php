<?php


namespace App\Policies\Nova;

use App\MarketingEmailTemplate;

class MarketingEmailTemplatePolicy extends AbstractNovaPermissionHandler
{
	public $resource = MarketingEmailTemplate::class;
}
