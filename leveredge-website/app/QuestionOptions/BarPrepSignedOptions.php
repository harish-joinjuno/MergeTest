<?php


namespace App\QuestionOptions;

class BarPrepSignedOptions implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        $options = [
            'No',
            'Yes, paid a deposit',
            'Yes, paid in full',
        ];

        return array_map(function ($option) {
            return [
                'label' => $option,
                'value' => $option,
            ];
        }, $options);
    }
}
