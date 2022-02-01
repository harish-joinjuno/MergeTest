<?php


namespace App\QuestionOptions;

class BarPrepExams implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            [
                'label' => "I don't know yet",
                'value' => "I don't know yet",
            ],
            [
                'label' => "2021 - February",
                'value' => "2021 February",
            ],
            [
                'label' => "2021 - July",
                'value' => "2021 July",
            ],
            [
                'label' => "2022 - February",
                'value' => "2021 February",
            ],
            [
                'label' => "2022 - July",
                'value' => "2022 July",
            ],
            [
                'label' => "2023 - February",
                'value' => "2023 February",
            ],
            [
                'label' => "2023 - July",
                'value' => "2023 July",
            ],
            [
                'label' => "2024 - February",
                'value' => "2024 February",
            ],
            [
                'label' => "2024 - July",
                'value' => "2024 July",
            ],

        ];
    }
}
