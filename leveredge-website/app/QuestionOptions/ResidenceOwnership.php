<?php


namespace App\QuestionOptions;

class ResidenceOwnership implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            [
                'label' => 'Family member owned',
                'value' => 'Family member owned',
            ],
            [
                'label' => 'Self-Owned',
                'value' => 'Self-Owned',
            ],
            [
                'label' => 'Rent',
                'value' => 'Rent',
            ],
        ];
    }
}
