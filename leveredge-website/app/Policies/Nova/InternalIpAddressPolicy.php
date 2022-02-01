<?php


namespace App\Policies\Nova;


use App\InternalIpAddress;

class InternalIpAddressPolicy extends AbstractNovaPermissionHandler
{
    public $resource = InternalIpAddress::class;
}
