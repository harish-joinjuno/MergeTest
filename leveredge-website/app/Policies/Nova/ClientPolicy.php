<?php


namespace App\Policies\Nova;


use App\Client;

class ClientPolicy extends AbstractNovaPermissionHandler
{
    public $resource = Client::class;
}
