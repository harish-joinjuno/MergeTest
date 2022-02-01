<?php


namespace App\QuestionOptions;

class FixedVariableNotSure implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            [
                'label' => 'Fixed',
                'value' => 'fixed',
            ],
            [
                'label' => 'Variable',
                'value' => 'variable',
            ],
            [
                'label' => "I'm not sure",
                'value' => 'im-not-sure',
            ],
        ];
    }
}
