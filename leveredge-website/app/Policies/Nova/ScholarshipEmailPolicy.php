<?php


namespace App\Policies\Nova;


use App\ScholarshipEmail;

class ScholarshipEmailPolicy extends AbstractNovaPermissionHandler
{
    public $resource = ScholarshipEmail::class;
}
