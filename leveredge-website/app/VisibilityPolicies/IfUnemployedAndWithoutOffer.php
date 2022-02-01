<?php


namespace App\VisibilityPolicies;

use App\University;

class IfUnemployedAndWithoutOffer implements \App\Contracts\VisibilityPolicyInterface
{
    public function getDefinition()
    {
        $visibleFullTimeOfferResponses = [
            'no',
        ];

        $visibleCurrentlyEmployedResponses = [
            '1',
        ];

        return [
            'method'              => 'based-on-value-of-multiple-inputs-on-page',
            'inputs'              => [
                [
                    'field_name'          => 'full_time_offer',
                    'visible_values'      => $visibleFullTimeOfferResponses,
                    'hidden_values'       => null,
                    'default_visibility'  => false,
                ],
                [
                    'field_name'          => 'is_currently_employed',
                    'visible_values'      => $visibleCurrentlyEmployedResponses,
                    'hidden_values'       => null,
                    'default_visibility'  => false,
                ],
            ],
        ];
    }
}
