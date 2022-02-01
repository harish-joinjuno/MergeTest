<?php


namespace App\Policies\Nova;

use App\PageSection;

class PageSectionPolicy extends AbstractNovaPermissionHandler
{
    public $resource = PageSection::class;
}
