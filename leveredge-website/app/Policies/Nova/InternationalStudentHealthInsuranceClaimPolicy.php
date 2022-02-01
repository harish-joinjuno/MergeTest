<?php


namespace App\Policies\Nova;



use App\InternationalStudentHealthInsuranceClaim;

class InternationalStudentHealthInsuranceClaimPolicy extends AbstractNovaPermissionHandler
{
    public $resource = InternationalStudentHealthInsuranceClaim::class;
}
