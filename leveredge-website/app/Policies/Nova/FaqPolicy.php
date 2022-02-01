<?php


namespace App\Policies\Nova;


use App\Faq;

class FaqPolicy extends AbstractNovaPermissionHandler
{
    public $resource = Faq::class;
}
