<?php


namespace App\Redirects\QuestionFlowRedirects;


use App\Abstracts\Redirects\RedirectToQuestionFlow;
use App\QuestionFlow;

class RedirectToAutoLoansPartnerQuestionFlow extends RedirectToQuestionFlow
{

    function getQuestionFlow(): QuestionFlow
    {
        return QuestionFlow::find(QuestionFlow::AUTO_LOANS_PARTNER_FLOW_ID);
    }
}
