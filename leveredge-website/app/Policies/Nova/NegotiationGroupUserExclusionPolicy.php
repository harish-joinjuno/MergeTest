<?php


namespace App\Policies\Nova;

use App\NegotiationGroupUserExclusion;

class NegotiationGroupUserExclusionPolicy extends AbstractNovaPermissionHandler
{
    public $resource = NegotiationGroupUserExclusion::class;
}
