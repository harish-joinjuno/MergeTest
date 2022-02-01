<?php


namespace App\Policies\Nova;


use App\QuestionPageResponder;

class QuestionPageResponderPolicy extends AbstractNovaPermissionHandler
{
    public $resource = QuestionPageResponder::class;
}
