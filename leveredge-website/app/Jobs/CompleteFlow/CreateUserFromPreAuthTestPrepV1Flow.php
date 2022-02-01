<?php


namespace App\Jobs\CompleteFlow;

use App\Jobs\CompleteFlow\Abstracts\RegisterUsersFromPreAuthFlow;
use App\QuestionFlow;
use App\Traits\InteractsWithResponder;

class CreateUserFromPreAuthTestPrepV1Flow extends RegisterUsersFromPreAuthFlow
{
    use InteractsWithResponder;

    public function getQuestionFlow(): QuestionFlow
    {
        return QuestionFlow::find(QuestionFlow::COLLEGE_TEST_PREP_STANDALONE_ID);
    }
}
