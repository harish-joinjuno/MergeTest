<?php


namespace App\Jobs\CompleteFlow;


use App\Jobs\CompleteFlow\Abstracts\RegisterUsersFromPreAuthFlow;
use App\QuestionFlow;
use App\Traits\InteractsWithResponder;

class CreateUserFromPreAuthInternationalStudentHealthInsurance extends RegisterUsersFromPreAuthFlow
{
    use InteractsWithResponder;

    public function getQuestionFlow(): QuestionFlow
    {
        return QuestionFlow::find(QuestionFlow::INTERNATIONAL_STUDENT_HEALTH_INSURANCE_FLOW_ID);
    }
}
