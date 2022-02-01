<?php


namespace App\Policies\Nova;


use App\QuestionResponder;

class QuestionResponderPolicy extends AbstractNovaPermissionHandler
{
    public $resource = QuestionResponder::class;
}
