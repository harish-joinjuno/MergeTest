<?php


namespace App\QuestionOptions;


class BarPrepPriorityOptions
{
    public function options()
    {
        $options = [
            'Lowest price',
            'Best value',
            'Highest chance of passing',
            'What my friends are taking',
            'Live classes',
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
