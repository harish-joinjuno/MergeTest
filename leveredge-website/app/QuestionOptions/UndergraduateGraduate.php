<?php


namespace App\QuestionOptions;

class UndergraduateGraduate implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            [
                'label'       => 'Undergraduate',
                'value'       => 'undergraduate',
                'description' => 'For current or incoming undergraduate students and their parents/guardians',
            ],
            [
                'label'       => 'Graduate',
                'value'       => 'graduate',
                'description' => 'For current or incoming MBA, JD, MD, and other graduate students.',
            ],
        ];
    }
}
