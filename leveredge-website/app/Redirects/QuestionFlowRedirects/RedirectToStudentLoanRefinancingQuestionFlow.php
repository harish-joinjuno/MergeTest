<?php


namespace App\Redirects\QuestionFlowRedirects;


use App\Abstracts\Redirects\RedirectToQuestionFlow;
use App\QuestionFlow;

class RedirectToStudentLoanRefinancingQuestionFlow extends RedirectToQuestionFlow
{

    function getQuestionFlow(): QuestionFlow
    {
        return QuestionFlow::find(QuestionFlow::STUDENT_LOAN_REFINANCING_FLOW_ID);
    }
}
