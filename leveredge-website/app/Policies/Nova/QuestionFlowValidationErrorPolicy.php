<?php


namespace App\Policies\Nova;


use App\QuestionFlowValidationError;

class QuestionFlowValidationErrorPolicy extends AbstractNovaPermissionHandler
{
    public $resource = QuestionFlowValidationError::class;
}
