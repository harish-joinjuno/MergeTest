<?php


namespace App\Jobs\CompleteFlow;


use App\Jobs\CompleteFlow\Abstracts\RegisterUsersFromPreAuthFlow;
use App\QuestionFlow;
use App\Traits\InteractsWithResponder;

class CreateUserFromPreAuthStudentLoanFlow extends RegisterUsersFromPreAuthFlow
{
    use InteractsWithResponder;

    public function getQuestionFlow(): QuestionFlow
    {
        return QuestionFlow::find(QuestionFlow::STUDENT_LOAN_QUESTION_FLOW_ID);
    }
}
