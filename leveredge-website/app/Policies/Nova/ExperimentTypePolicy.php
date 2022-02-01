<?php


namespace App\Policies\Nova;


use App\ExperimentType;

class ExperimentTypePolicy extends AbstractNovaPermissionHandler
{
    public $resource = ExperimentType::class;
}
