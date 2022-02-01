<?php


namespace App\Policies\Nova;

use App\PressRelease;

class PressReleasePolicy extends AbstractNovaPermissionHandler
{
	public $resource = PressRelease::class;
}
