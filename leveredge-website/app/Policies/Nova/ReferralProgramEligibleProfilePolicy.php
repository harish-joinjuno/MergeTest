<?php


namespace App\Policies\Nova;

use App\ReferralProgramEligibleProfile;

class ReferralProgramEligibleProfilePolicy extends AbstractNovaPermissionHandler
{
	public $resource = ReferralProgramEligibleProfile::class;
}
