<?php


namespace App\Policies\Nova;

use App\ScreenshotClaim;

class ScreenshotClaimPolicy extends AbstractNovaPermissionHandler
{
    public $resource = ScreenshotClaim::class;
}
