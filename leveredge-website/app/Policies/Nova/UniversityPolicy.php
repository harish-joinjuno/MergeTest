<?php


namespace App\Policies\Nova;

use App\University;

class UniversityPolicy extends AbstractNovaPermissionHandler
{
	public $resource = University::class;
}
