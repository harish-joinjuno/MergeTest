<?php


namespace App\PersistResponse;

use App\Client;
use App\Contracts\PersistResponseInterface;
use App\Question;
use App\QuestionResponder;
use App\Traits\CreatesQuestionResponder;
use App\User;

class PersistInQuestionResponderOnly implements PersistResponseInterface
{
    use CreatesQuestionResponder;

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function persist(Question $question,$needToSaveFromResponder = false)
    {
        $field_name = $question->field_name;
        $response   = request()->get($field_name);
        $this->createQuestionResponderFromQuestionId($question->id,$response);
    }

    public function getPersistedValue(Question $question)
    {
        if (auth()->check()) {
            $responder_type = User::class;
            $responder_id   = user()->id;
        } else {
            $responder_type = Client::class;
            $responder_id   = getClientId();
        }

        $questionResponder = QuestionResponder::where('question_id',$question->id)
            ->where('responder_id',$responder_id)
            ->where('responder_type',$responder_type)
            ->orderBy('id','desc')
            ->first();

        if ($questionResponder) {
            return $questionResponder->response;
        }

        return null;
    }

    public function acceptsFieldName(string $fieldName)
    {
        return true;
    }
}
