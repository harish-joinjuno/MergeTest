<?php


namespace App\Policies\Nova;

use App\PartnerProfile;

class PartnerPolicy extends AbstractNovaPermissionHandler
{
	public $resource = PartnerProfile::class;
}
