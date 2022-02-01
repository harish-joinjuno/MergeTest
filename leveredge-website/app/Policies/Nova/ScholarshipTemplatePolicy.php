<?php


namespace App\Policies\Nova;

use App\ScholarshipTemplate;

class ScholarshipTemplatePolicy extends AbstractNovaPermissionHandler
{
    public $resource = ScholarshipTemplate::class;
}
