<?php


namespace App\Policies\Nova;


use App\Country;

class CountryPolicy extends AbstractNovaPermissionHandler
{
    public $resource = Country::class;
}
