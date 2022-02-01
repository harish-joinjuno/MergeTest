<?php


namespace App\Policies\Nova;

use App\UndergradDegree;

class UndergradDegreePolicy extends AbstractNovaPermissionHandler
{
	public $resource = Degree::class;
}
