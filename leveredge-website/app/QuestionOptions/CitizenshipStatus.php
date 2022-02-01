<?php


namespace App\QuestionOptions;

use App\UserProfile;
use Illuminate\Database\Eloquent\Collection;

class CitizenshipStatus implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        $citizenship_statuses = UserProfile::CITIZENSHIP_STATUSES;

        return array_map(function($item) {
            return [
                'label' => $item,
                'value' => $item,
            ];
        },$citizenship_statuses);
    }
}
