<?php


namespace App\Abstracts\Redirects;


use App\Contracts\Redirects\RedirectsInterface;
use App\QuestionFlow;

abstract class RedirectToQuestionFlow implements RedirectsInterface
{
    public function url(): string
    {
        return $this->getQuestionFlow()->getFlowInitUrl();
    }

    abstract function getQuestionFlow(): QuestionFlow;
}
