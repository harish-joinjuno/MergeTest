<?php


namespace App\QuestionOptions;

use App\HeardFromOption;
use Illuminate\Database\Eloquent\Collection;

class HeardFromOptions implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        /** @var Collection $collection */
        $collection = HeardFromOption::all();
        $keyed      = $collection->map(function($item) {
            return [
                'label' => $item['name'],
                'value' => $item['id'],
            ];
        });

        return $keyed->all();
    }
}
