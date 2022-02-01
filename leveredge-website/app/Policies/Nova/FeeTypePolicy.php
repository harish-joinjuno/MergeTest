<?php


namespace App\Policies\Nova;

use App\FeeType;

class FeeTypePolicy extends AbstractNovaPermissionHandler
{
	public $resource = FeeType::class;
}
