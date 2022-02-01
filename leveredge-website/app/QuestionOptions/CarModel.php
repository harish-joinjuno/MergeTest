<?php


namespace App\QuestionOptions;

use Illuminate\Database\Eloquent\Collection;

class CarModel implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        /** @var Collection $collection */
        $collection = \App\CarModel::orderBy('model','asc')->get();
        $keyed      = $collection->map(function($item) {
            return [
                'label' => $item['model'],
                'value' => $item['id'],
            ];
        });

        return $keyed->all();
    }
}
