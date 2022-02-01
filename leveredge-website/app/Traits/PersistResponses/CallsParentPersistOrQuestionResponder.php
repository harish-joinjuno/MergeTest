<?php


namespace App\Traits\PersistResponses;


use App\Question;
use App\Traits\CreatesQuestionResponder;

trait CallsParentPersistOrQuestionResponder
{
    use CreatesQuestionResponder;

    public function persist(Question $question, $needToSaveFromResponder = false)
    {
        if (auth()->check()) {

            parent::persist($question, $needToSaveFromResponder);

            return;
        }

        $field_name = $question->field_name;
        $response   = request()->get($field_name);
        $this->createQuestionResponderFromQuestionId($question->id,$response);
    }
}
