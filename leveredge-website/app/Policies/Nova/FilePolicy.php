<?php


namespace App\Policies\Nova;


use App\File;

class FilePolicy extends AbstractNovaPermissionHandler
{
    public $resource = File::class;
}
