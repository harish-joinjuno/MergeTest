<?php


namespace App\Policies\Nova;

use App\ScholarshipContent;

class ScholarshipContentPolicy extends AbstractNovaPermissionHandler
{
    public $resource = ScholarshipContent::class;
}
