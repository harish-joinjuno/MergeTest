<?php


namespace App\Policies\Nova;


use App\FootNote;

class FootNotePolicy extends AbstractNovaPermissionHandler
{
    public $resource = FootNote::class;
}
