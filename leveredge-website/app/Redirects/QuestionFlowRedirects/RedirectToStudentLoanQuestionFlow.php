<?php


namespace App\Redirects\QuestionFlowRedirects;


use App\Abstracts\Redirects\RedirectToQuestionFlow;
use App\QuestionFlow;

class RedirectToStudentLoanQuestionFlow extends RedirectToQuestionFlow
{

    function getQuestionFlow(): QuestionFlow
    {
        return QuestionFlow::find(QuestionFlow::STUDENT_LOAN_QUESTION_FLOW_ID);
    }
}
