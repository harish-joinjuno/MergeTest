<?php


namespace App\QuestionOptions;

use App\UserProfile;

class ExistingStudentLoanTypeOptions implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            [
                'label' => 'Private',
                'value' => 'private',
            ],
            [
                'label' => 'Federal',
                'value' => 'federal',
            ],
            [
                'label' => 'Both',
                'value' => 'both',
            ],
        ];
    }
}
