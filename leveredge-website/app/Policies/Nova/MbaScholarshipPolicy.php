<?php


namespace App\Policies\Nova;

use App\MbaScholarship;

class MbaScholarshipPolicy extends AbstractNovaPermissionHandler
{
	public $resource = MbaScholarship::class;
}
