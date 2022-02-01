<?php

namespace App\Http\Controllers;

use App\Client;
use App\QuestionResponder;
use App\Traits\CreatesQuestionResponder;
use App\User;
use Illuminate\Http\Request;

class SaveQuestionResponse extends Controller
{
    use CreatesQuestionResponder;

    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'response'    => 'nullable',
        ]);


        $this->createQuestionResponderFromQuestionId($validatedData['question_id'],$validatedData['response']);
    }
}
