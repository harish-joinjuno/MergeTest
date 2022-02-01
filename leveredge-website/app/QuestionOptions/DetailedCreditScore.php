<?php


namespace App\QuestionOptions;
use App\UserProfile;
use Illuminate\Database\Eloquent\Collection;

class DetailedCreditScore implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        $credit_scores = [
            'Less than 500',
            '500 - 520',
            '521 - 540',
            '541 - 560',
            '561 - 580',
            '581 - 600',
            '601 - 620',
            '621 - 640',
            '641 - 660',
            '661 - 680',
            '681 - 700',
            '701 - 720',
            '721 - 740',
            '741 - 760',
            '761 - 780',
            '781 - 800',
            'Greater than 800',
        ];

        return array_map(function($item) {
            return [
                'label' => $item,
                'value' => $item,
            ];
        },$credit_scores);
    }
}
