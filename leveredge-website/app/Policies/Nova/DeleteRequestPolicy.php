<?php


namespace App\Policies\Nova;


use App\DeleteRequest;

class DeleteRequestPolicy extends AbstractNovaPermissionHandler
{
    public $resource = DeleteRequest::class;
}
