<?php


namespace App\Policies\Nova;

use App\TrackedLink;

class TrackedLinkPolicy extends AbstractNovaPermissionHandler
{
	public $resource = TrackedLink::class;
}
