<?php


namespace App\Policies\Nova;


use App\NegotiationGroupUserLeave;

class NegotiationGroupUserLeavePolicy extends AbstractNovaPermissionHandler
{
    public $resource = NegotiationGroupUserLeave::class;
}
