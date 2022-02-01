<?php


namespace App\Policies\Nova;


use App\QuestionFlow;

class QuestionFlowPolicy extends AbstractNovaPermissionHandler
{
    public $resource = QuestionFlow::class;
}
