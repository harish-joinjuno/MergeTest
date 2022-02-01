<?php


namespace App\Exceptions;


class QuestionFlowNotStartedException extends \Exception
{
    private $questionFlowSlug;

    public function __construct($questionFlowSlug)
    {
        parent::__construct();

        $this->questionFlowSlug = $questionFlowSlug;
    }

    public function getQuestionFlowSlug()
    {
        return $this->questionFlowSlug;
    }
}
