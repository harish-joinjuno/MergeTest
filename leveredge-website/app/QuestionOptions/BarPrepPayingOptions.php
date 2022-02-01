<?php


namespace App\QuestionOptions;

class BarPrepPayingOptions implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        $options = [
            'Paying myself',
            'Employer stipend',
            'Employer direct bill',
            'Other',
        ];

        return array_map(function ($option) {
            return [
                'label' => $option,
                'value' => $option,
            ];
        }, $options);
    }
}
