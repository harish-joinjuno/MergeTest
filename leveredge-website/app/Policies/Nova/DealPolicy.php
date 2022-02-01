<?php


namespace App\Policies\Nova;

use App\Deal;

class DealPolicy extends AbstractNovaPermissionHandler
{
	public $resource = Deal::class;
}
