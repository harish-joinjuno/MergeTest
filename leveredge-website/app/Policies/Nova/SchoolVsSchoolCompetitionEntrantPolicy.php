<?php


namespace App\Policies\Nova;

use App\SchoolVsSchoolCompetitionEntrant;

class SchoolVsSchoolCompetitionEntrantPolicy extends AbstractNovaPermissionHandler
{
	public $resource = SchoolVsSchoolCompetitionEntrant::class;
}
