<?php


namespace App\Policies\Nova;


use App\NegotiationGroupEndScreen;

class NegotiationGroupEndScreenPolicy extends AbstractNovaPermissionHandler
{
    public $resource = NegotiationGroupEndScreen::class;
}
