<?php


namespace App\QuestionOptions;

class EmploymentStatus implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            [
                'label' => 'Full time',
                'value' => 'Full time',
            ],
            [
                'label' => 'Part time',
                'value' => 'Part time',
            ],
            [
                'label' => 'Retired',
                'value' => 'Retired',
            ],
            [
                'label' => 'Student',
                'value' => 'Student',
            ],
            [
                'label' => 'Active Duty Military',
                'value' => 'Active Duty Military',
            ],
            [
                'label' => 'Unemployed',
                'value' => 'Unemployed',
            ],
            [
                'label' => 'Other',
                'value' => 'Other',
            ],
        ];
    }
}
