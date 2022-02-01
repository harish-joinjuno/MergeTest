<?php


namespace App\Policies\Nova;

use App\ReferralProgram;

class ReferralProgramPolicy extends AbstractNovaPermissionHandler
{
	public $resource = ReferralProgram::class;
}
