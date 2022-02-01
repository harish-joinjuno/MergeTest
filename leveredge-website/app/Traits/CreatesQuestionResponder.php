<?php


namespace App\Traits;


use App\Client;
use App\QuestionResponder;
use App\User;

trait CreatesQuestionResponder
{
    use InteractsWithResponder;

    /**
     * @param int $question_id
     * @param $response
     * @throws \Exception
     * @return QuestionResponder
     */
    protected function createQuestionResponderFromQuestionId(int $question_id, $response): QuestionResponder
    {
        list($responder_id, $responder_type) = $this->getResponderIdAndType();

        $questionResponder                 = new QuestionResponder;
        $questionResponder->responder_id   = $responder_id;
        $questionResponder->responder_type = $responder_type;
        $questionResponder->question_id    = $question_id;
        $questionResponder->response       = $response;
        $questionResponder->save();

        return $questionResponder;
    }

}
