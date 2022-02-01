<?php


namespace App\QuestionOptions;


use Illuminate\Database\Eloquent\Collection;

class Country implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        /** @var Collection $collection */
        $collection = \App\Country::orderBy('name')->get();
        $keyed      = $collection->map(function($item) {
            return [
                'label' => $item['name'],
                'value' => $item['id'],
            ];
        });

        return $keyed->all();
    }
}
