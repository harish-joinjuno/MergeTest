<?php


namespace App\QuestionOptions;
use App\UserProfile;
use Illuminate\Database\Eloquent\Collection;

class CreditScore implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        $credit_scores = UserProfile::CREDIT_SCORES;

        return array_map(function($item) {
            return [
                'label' => $item,
                'value' => $item,
            ];
        },$credit_scores);
    }
}
