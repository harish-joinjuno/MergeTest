<?php


namespace App\Policies\Nova;


use App\DealStatus;

class DealStatusPolicy extends AbstractNovaPermissionHandler
{
    public $resource = DealStatus::class;
}
