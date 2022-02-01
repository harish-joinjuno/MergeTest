<?php


namespace App\QuestionOptions;

use App\UserProfile;
use Illuminate\Database\Eloquent\Collection;

class StudentParent implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        $role = [UserProfile::ROLE_STUDENT,UserProfile::ROLE_PARENT];

        return array_map(function($item) {
            return [
                'label' => $item,
                'value' => $item,
            ];
        },$role);
    }
}
