<?php


namespace App\QuestionOptions;
use Illuminate\Database\Eloquent\Collection;

class YesNoMaybe implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            ['label' => 'Yes', 'value' => 'Yes' ],
            ['label' => 'No', 'value' => 'No' ],
            ['label' => 'Maybe', 'value' => 'Maybe' ],
        ];
    }
}
