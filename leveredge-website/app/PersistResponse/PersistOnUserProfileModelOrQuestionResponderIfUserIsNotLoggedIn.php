<?php


namespace App\PersistResponse;


use App\Traits\PersistResponses\CallsParentPersistOrQuestionResponder;

class PersistOnUserProfileModelOrQuestionResponderIfUserIsNotLoggedIn extends PersistOnUserProfileModel
{
    use CallsParentPersistOrQuestionResponder;

    public function __construct()
    {
        parent::__construct(true);
    }
}
