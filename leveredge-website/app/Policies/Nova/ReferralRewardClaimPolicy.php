<?php


namespace App\Policies\Nova;

use App\ReferralRewardClaim;

class ReferralRewardClaimPolicy extends AbstractNovaPermissionHandler
{
	public $resource = ReferralRewardClaim::class;
}
