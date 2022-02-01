<?php


namespace App\Policies\Nova;

use App\DealType;

class DealTypePolicy extends AbstractNovaPermissionHandler
{
	public $resource = DealType::class;
}
