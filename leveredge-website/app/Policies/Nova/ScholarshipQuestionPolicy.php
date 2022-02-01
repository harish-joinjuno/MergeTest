<?php


namespace App\Policies\Nova;

use App\ScholarshipQuestion;

class ScholarshipQuestionPolicy extends AbstractNovaPermissionHandler
{
    public $resource = ScholarshipQuestion::class;
}
