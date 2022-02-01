<?php


namespace App\Policies\Nova;

use App\Degree;

class GradDegreePolicy extends AbstractNovaPermissionHandler
{
	public $resource = Degree::class;
}
