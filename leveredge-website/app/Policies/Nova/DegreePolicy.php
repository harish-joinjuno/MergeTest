<?php


namespace App\Policies\Nova;


use App\Degree;

class DegreePolicy extends AbstractNovaPermissionHandler
{
    public $resource = Degree::class;
}
