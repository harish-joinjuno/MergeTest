<?php


namespace App\Policies\Nova;


use App\ClientEvent;

class ClientEventPolicy extends AbstractNovaPermissionHandler
{
    public $resource = ClientEvent::class;
}
