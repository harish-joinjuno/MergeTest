<?php


namespace App\QuestionOptions;

use Illuminate\Database\Eloquent\Collection;

class CarMake implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        /** @var Collection $collection */
        $collection = \App\CarMake::orderBy('make','asc')->get();
        $keyed      = $collection->map(function($item) {
            return [
                'label' => $item['make'],
                'value' => $item['id'],
            ];
        });

        return $keyed->all();
    }
}
