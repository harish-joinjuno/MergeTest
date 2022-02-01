<?php


namespace App\Policies\Nova;

use App\LawSchool;

class LawSchoolPolicy extends AbstractNovaPermissionHandler
{
	public $resource = LawSchool::class;
}
