<?php


namespace App\Policies\Nova;


use App\SchoolVsSchoolCompetition;

class SchoolVsSchoolCompetitionPolicy extends AbstractNovaPermissionHandler
{
    public $resource = SchoolVsSchoolCompetition::class;
}
