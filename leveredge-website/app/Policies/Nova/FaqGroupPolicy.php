<?php


namespace App\Policies\Nova;


use App\FaqGroup;

class FaqGroupPolicy extends AbstractNovaPermissionHandler
{
    public $resource = FaqGroup::class;
}
