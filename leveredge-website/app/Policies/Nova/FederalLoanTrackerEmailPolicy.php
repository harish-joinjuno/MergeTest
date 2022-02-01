<?php


namespace App\Policies\Nova;


use App\FederalLoanTrackerEmail;

class FederalLoanTrackerEmailPolicy  extends AbstractNovaPermissionHandler
{
    public $resource = FederalLoanTrackerEmail::class;
}
