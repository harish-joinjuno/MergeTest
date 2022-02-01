<?php


namespace App\Policies\Nova;


use App\DealStatusApplicability;

class DealStatusApplicabilityPolicy extends AbstractNovaPermissionHandler
{
    public $resource = DealStatusApplicability::class;
}
