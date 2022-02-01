<?php


namespace App\Policies\Nova;

use App\AcademicYear;

class AcademicYearPolicy extends AbstractNovaPermissionHandler
{
	public $resource = AcademicYear::class;
}
