<?php


namespace App\SkipPolicies;


use App\Question;

class IfWentToGraduateSchoolIsYes implements \App\Contracts\SkipPolicyInterface
{

    public function check()
    {
        if (auth()->check()) {
            return strtolower(user()->profile->went_to_graduate_school) === 'yes';
        }

        $responder = app('client_question_responders')->where('question_id', Question::GRADUATE_QUESTION_ID)->first();

        if ($responder) {
            return strtolower($responder->response) === 'yes';
        }

        return false;
    }
}
