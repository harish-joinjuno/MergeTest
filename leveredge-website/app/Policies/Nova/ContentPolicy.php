<?php


namespace App\Policies\Nova;


use App\Content;

class ContentPolicy extends AbstractNovaPermissionHandler
{
    public $resource = Content::class;
}
