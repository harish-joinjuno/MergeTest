<?php


namespace App\Policies\Nova;


use App\Experiment;

class ExperimentPolicy extends AbstractNovaPermissionHandler
{
    public $resource = Experiment::class;
}
