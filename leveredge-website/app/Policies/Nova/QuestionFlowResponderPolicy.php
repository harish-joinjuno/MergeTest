<?php


namespace App\Policies\Nova;


use App\QuestionFlowResponder;

class QuestionFlowResponderPolicy extends AbstractNovaPermissionHandler
{
    public $resource = QuestionFlowResponder::class;
}
