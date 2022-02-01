<?php


namespace App\QuestionOptions;


class YesNoBoolean implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            ['label' => 'Yes', 'value' => '1' ],
            ['label' => 'No', 'value' => '0' ],
        ];
    }
}
