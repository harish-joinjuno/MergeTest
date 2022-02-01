<?php


namespace App\QuestionOptions;


class BarPrepPreferredCompanyOptions implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        $options = [
            'BarBri',
            'Themis',
            'Kaplan',
            'BarMax',
            'Crushendo',
            'AmeriBar',
            'Critical Pass',
            'Pieper',
            'Fleming\’s',
            'Rigos',
            'SmartBarPrep',
            'Reed Bar Review',
            'AdaptiBar',
            'Quimbeee',
            'Bar Prep Hero',
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
