<?php


namespace App\Policies\Nova;

use App\AccessTheDeal;

class AccessTheDealPolicy extends AbstractNovaPermissionHandler
{
	public $resource = AccessTheDeal::class;
}
