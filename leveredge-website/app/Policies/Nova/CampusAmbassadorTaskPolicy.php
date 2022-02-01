<?php


namespace App\Policies\Nova;

use App\CampusAmbassadorTask;

class CampusAmbassadorTaskPolicy extends AbstractNovaPermissionHandler
{
	public $resource = CampusAmbassadorTask::class;
}
