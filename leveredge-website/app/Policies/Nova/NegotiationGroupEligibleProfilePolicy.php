<?php


namespace App\Policies\Nova;

use App\NegotiationGroupEligibleProfile;

class NegotiationGroupEligibleProfilePolicy extends AbstractNovaPermissionHandler
{
	public $resource = NegotiationGroupEligibleProfile::class;
}
