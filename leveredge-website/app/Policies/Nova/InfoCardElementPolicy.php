<?php


namespace App\Policies\Nova;


use App\InfoCardElement;

class InfoCardElementPolicy extends AbstractNovaPermissionHandler
{
    public $resource = InfoCardElement::class;
}
