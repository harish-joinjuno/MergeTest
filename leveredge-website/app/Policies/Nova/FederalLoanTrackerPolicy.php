<?php


namespace App\Policies\Nova;


use App\FederalLoanTrackerEmail;

class FederalLoanTrackerPolicy extends AbstractNovaPermissionHandler
{
    public $resource = FederalLoanTrackerEmail::class;
}
