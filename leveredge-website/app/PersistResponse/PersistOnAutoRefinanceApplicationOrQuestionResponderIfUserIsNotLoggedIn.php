<?php


namespace App\PersistResponse;


use App\Traits\PersistResponses\CallsParentPersistOrQuestionResponder;

class PersistOnAutoRefinanceApplicationOrQuestionResponderIfUserIsNotLoggedIn extends PersistOnAutoRefinanceApplication
{
    use CallsParentPersistOrQuestionResponder;

    public function __construct()
    {
        parent::__construct(true);
    }
}
