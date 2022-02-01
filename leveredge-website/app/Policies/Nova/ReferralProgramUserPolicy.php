<?php


namespace App\Policies\Nova;

use App\ReferralProgramUser;

class ReferralProgramUserPolicy extends AbstractNovaPermissionHandler
{
	public $resource = ReferralProgramUser::class;
}
