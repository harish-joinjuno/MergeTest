<?php


namespace App\Policies\Nova;

use App\Rate;

class RatePolicy extends AbstractNovaPermissionHandler
{
    public $resource = Rate::class;
}
