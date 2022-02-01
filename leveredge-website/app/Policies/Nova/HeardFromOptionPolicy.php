<?php


namespace App\Policies\Nova;



use App\HeardFromOption;

class HeardFromOptionPolicy extends AbstractNovaPermissionHandler
{
    public $resource = HeardFromOption::class;
}
