<?php


namespace App\Policies\Nova;


use App\SocialProvider;

class SocialProviderPolicy extends AbstractNovaPermissionHandler
{
    public $resource = SocialProvider::class;
}
