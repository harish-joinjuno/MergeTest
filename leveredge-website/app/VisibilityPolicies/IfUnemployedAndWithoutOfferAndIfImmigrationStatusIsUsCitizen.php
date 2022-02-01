<?php


namespace App\VisibilityPolicies;

use App\Contracts\VisibilityPolicyInterface;
use App\UserProfile;

class IfUnemployedAndWithoutOfferAndIfImmigrationStatusIsUsCitizen implements VisibilityPolicyInterface
{
    public function getDefinition()
    {
        $visibleFullTimeOfferResponses = [
            'no',
        ];

        $visibleCurrentlyEmployedResponses = [
            '1',
        ];

        $visibleImmigrationStatusResponse = [
            UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
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
                [
                    'field_name'          => 'immigration_status',
                    'visible_values'      => $visibleImmigrationStatusResponse,
                    'hidden_values'       => null,
                    'default_visibility'  => false,
                ],
            ],
        ];
    }
}
