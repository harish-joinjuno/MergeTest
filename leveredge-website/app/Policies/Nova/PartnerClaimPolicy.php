<?php


namespace App\Policies\Nova;


use App\PartnerClaim;

class PartnerClaimPolicy extends AbstractNovaPermissionHandler
{
    public $resource = PartnerClaim::class;
}
