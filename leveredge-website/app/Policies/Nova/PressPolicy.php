<?php


namespace App\Policies\Nova;

use App\Press;

class PressPolicy extends AbstractNovaPermissionHandler
{
	public $resource = Press::class;
}
