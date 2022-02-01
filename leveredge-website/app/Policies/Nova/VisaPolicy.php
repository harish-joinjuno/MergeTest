<?php


namespace App\Policies\Nova;


use App\Visa;

class VisaPolicy extends AbstractNovaPermissionHandler
{
    public $resource = Visa::class;
}
