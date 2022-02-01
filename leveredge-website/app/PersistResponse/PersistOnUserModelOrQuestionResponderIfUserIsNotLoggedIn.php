<?php


namespace App\PersistResponse;


use App\Traits\PersistResponses\CallsParentPersistOrQuestionResponder;

class PersistOnUserModelOrQuestionResponderIfUserIsNotLoggedIn extends PersistOnUserModel
{
    use CallsParentPersistOrQuestionResponder;

    public function __construct()
    {
        parent::__construct(true);
    }
}
