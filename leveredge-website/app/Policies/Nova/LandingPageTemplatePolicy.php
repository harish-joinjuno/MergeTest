<?php


namespace App\Policies\Nova;

use App\LandingPageTemplate;

class LandingPageTemplatePolicy extends AbstractNovaPermissionHandler
{
    public $resource = LandingPageTemplate::class;
}
