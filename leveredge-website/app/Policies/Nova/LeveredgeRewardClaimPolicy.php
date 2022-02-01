<?php


namespace App\Policies\Nova;


use App\LeveredgeRewardClaim;

class LeveredgeRewardClaimPolicy extends AbstractNovaPermissionHandler
{
    public $resource = LeveredgeRewardClaim::class;
}
