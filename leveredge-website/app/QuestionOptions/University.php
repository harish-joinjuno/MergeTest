<?php


namespace App\QuestionOptions;

use Illuminate\Database\Eloquent\Collection;

class University implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        /** @var Collection $collection */
        $collection = \App\University::orderBy('name')->get();
        $keyed      = $collection->map(function($item) {
            return [
                'label' => $item['name'],
                'value' => $item['id'],
            ];
        });

        return $keyed->all();
    }
}
