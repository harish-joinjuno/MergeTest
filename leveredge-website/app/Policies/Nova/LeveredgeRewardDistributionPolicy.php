<?php


namespace App\Policies\Nova;

use App\LeveredgeRewardDistribution;

class LeveredgeRewardDistributionPolicy extends AbstractNovaPermissionHandler
{
    public $resource = LeveredgeRewardDistribution::class;
}
