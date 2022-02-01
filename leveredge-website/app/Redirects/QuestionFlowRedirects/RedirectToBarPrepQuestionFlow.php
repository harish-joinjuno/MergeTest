<?php


namespace App\Redirects\QuestionFlowRedirects;


use App\Abstracts\Redirects\RedirectToQuestionFlow;
use App\QuestionFlow;

class RedirectToBarPrepQuestionFlow extends RedirectToQuestionFlow
{

    function getQuestionFlow(): QuestionFlow
    {
        return QuestionFlow::find(QuestionFlow::BAR_PREP_FLOW_ID);
    }
}
