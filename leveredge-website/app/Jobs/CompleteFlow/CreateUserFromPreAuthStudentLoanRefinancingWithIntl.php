<?php


namespace App\Jobs\CompleteFlow;


use App\Jobs\CompleteFlow\Abstracts\RegisterUsersFromPreAuthFlow;
use App\QuestionFlow;
use App\Traits\InteractsWithResponder;

class CreateUserFromPreAuthStudentLoanRefinancingWithIntl extends RegisterUsersFromPreAuthFlow
{
    use InteractsWithResponder;

    public function getQuestionFlow(): QuestionFlow
    {
        return QuestionFlow::find(QuestionFlow::STUDENT_LOAN_REFINANCING_FLOW_ID);
    }
}
