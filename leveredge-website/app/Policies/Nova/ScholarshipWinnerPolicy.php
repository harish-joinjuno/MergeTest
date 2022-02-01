<?php


namespace App\Policies\Nova;

use App\ScholarshipWinner;

class ScholarshipWinnerPolicy extends AbstractNovaPermissionHandler
{
    public $resource = ScholarshipWinner::class;
}
