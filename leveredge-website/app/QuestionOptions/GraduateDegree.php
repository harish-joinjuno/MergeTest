<?php


namespace App\QuestionOptions;

use App\Degree;
use Illuminate\Database\Eloquent\Collection;

class GraduateDegree implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        /** @var Collection $collection */
        $collection = Degree::where('type','graduate')->get();
        $keyed      = $collection->map(function($item) {
            return [
                'label' => $item['name'],
                'value' => $item['id'],
            ];
        });

        return $keyed->all();
    }
}
