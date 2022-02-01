<?php


namespace App\QuestionOptions;

class CollegeTestPreference implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            [
                'label' => "SAT",
                'value' => "SAT",
            ],
            [
                'label' => "ACT",
                'value' => "ACT",
            ],
            [
                'label' => "Both",
                'value' => "Both",
            ],
        ];
    }
}
