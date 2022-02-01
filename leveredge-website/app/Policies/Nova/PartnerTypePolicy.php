<?php


namespace App\Policies\Nova;

use App\PartnerType;

class PartnerTypePolicy extends AbstractNovaPermissionHandler
{
	public $resource = PartnerType::class;
}
