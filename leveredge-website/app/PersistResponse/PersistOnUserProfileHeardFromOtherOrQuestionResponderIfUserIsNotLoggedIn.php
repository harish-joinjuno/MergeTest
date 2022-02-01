<?php


namespace App\PersistResponse;

use App\Traits\PersistResponses\CallsParentPersistOrQuestionResponder;

class PersistOnUserProfileHeardFromOtherOrQuestionResponderIfUserIsNotLoggedIn extends PersistOnUserProfileHeardFromOther
{
    use CallsParentPersistOrQuestionResponder;
}
