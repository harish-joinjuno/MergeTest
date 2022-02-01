<?php


namespace App\Policies\Nova;

use App\Scholarship;

class ScholarshipPolicy extends AbstractNovaPermissionHandler
{
    public $resource = Scholarship::class;
}
