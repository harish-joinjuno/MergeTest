<?php


namespace App\Policies\Nova;

use App\RateProperty;

class RatePropertyPolicy extends AbstractNovaPermissionHandler
{
    public $resource = RateProperty::class;
}
