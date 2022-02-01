<?php


namespace App\Policies\Nova;


use App\Redirect;

class RedirectPolicy extends AbstractNovaPermissionHandler
{
    public $resource = Redirect::class;
}
