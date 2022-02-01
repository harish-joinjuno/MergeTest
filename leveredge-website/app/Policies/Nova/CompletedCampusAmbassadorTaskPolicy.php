<?php


namespace App\Policies\Nova;

use App\CompletedCampusAmbassadorTask;

class CompletedCampusAmbassadorTaskPolicy extends AbstractNovaPermissionHandler
{
	public $resource = CompletedCampusAmbassadorTask::class;
}
