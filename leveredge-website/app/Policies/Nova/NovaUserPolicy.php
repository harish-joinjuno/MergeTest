<?php


namespace App\Policies\Nova;

use App\NovaUser;

class NovaUserPolicy extends AbstractNovaPermissionHandler
{
	public $resource = NovaUser::class;
}
