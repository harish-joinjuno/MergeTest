<?php


namespace App\SkipPolicies;


class IfWentToGraduateSchoolIsNo implements \App\Contracts\SkipPolicyInterface
{

    public function check()
    {
        if (auth()->check()) {
            return strtolower(user()->profile->went_to_graduate_school) === 'no';
        }

        $responder = app('client_question_responders')->where('question_id', 116)->first();

        if ($responder) {
            return strtolower($responder->response) === 'no';
        }

        return false;
    }
}
