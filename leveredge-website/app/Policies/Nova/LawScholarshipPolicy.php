<?php


namespace App\Policies\Nova;

use App\LawScholarship;

class LawScholarshipPolicy extends AbstractNovaPermissionHandler
{
	public $resource = LawScholarship::class;
}
