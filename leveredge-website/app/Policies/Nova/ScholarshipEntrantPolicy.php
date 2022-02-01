<?php


namespace App\Policies\Nova;

use App\ScholarshipEntrant;

class ScholarshipEntrantPolicy extends AbstractNovaPermissionHandler
{
    public $resource = ScholarshipEntrant::class;
}
