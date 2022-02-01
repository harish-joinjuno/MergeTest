<?php

namespace App\Policies\Nova;

use App\NovaResourcePermission;

class NovaResourcePermissionPolicy extends AbstractNovaPermissionHandler
{
    public $resource = NovaResourcePermission::class;
}
