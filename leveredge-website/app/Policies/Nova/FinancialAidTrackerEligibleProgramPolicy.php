<?php


namespace App\Policies\Nova;

use App\FinancialAidTrackerEligibleProgram;

class FinancialAidTrackerEligibleProgramPolicy extends AbstractNovaPermissionHandler
{
	public $resource = FinancialAidTrackerEligibleProgram::class;
}
