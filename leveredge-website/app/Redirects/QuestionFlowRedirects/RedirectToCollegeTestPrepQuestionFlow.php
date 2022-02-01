<?php


namespace App\Redirects\QuestionFlowRedirects;


use App\Abstracts\Redirects\RedirectToQuestionFlow;
use App\QuestionFlow;

class RedirectToCollegeTestPrepQuestionFlow extends RedirectToQuestionFlow
{

    function getQuestionFlow(): QuestionFlow
    {
        return QuestionFlow::find(QuestionFlow::COLLEGE_TEST_PREP_ID);
    }
}
