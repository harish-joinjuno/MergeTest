<?php


namespace App\Policies\Nova;


use App\CareerOneStopScholarship;

class CareerOneStopScholarshipPolicy extends AbstractNovaPermissionHandler
{
    public $resource = CareerOneStopScholarship::class;
}
