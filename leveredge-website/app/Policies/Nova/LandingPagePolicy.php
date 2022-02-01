<?php


namespace App\Policies\Nova;

use App\LandingPage;

class LandingPagePolicy extends AbstractNovaPermissionHandler
{
	public $resource = LandingPage::class;
}
