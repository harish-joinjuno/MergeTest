<?php


namespace App\VisibilityPolicies;


use App\Contracts\VisibilityPolicyInterface;
use App\UserProfile;

class IfAlreadyGraduatedAndImmigrationIsUsCitizen implements VisibilityPolicyInterface
{

    public function getDefinition()
    {
        $visibleImmigrationStatusesResponses = [
            UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
        ];

        return [
            'method'              => 'based-on-value-of-callable-multiple-inputs-and-other-input-on-page',
            'inputs'              => [
                [
                    'field_name'          => 'graduate_month_year',
                    'hidden_values'       => null,
                    'default_visibility'  => false,
                    'callable'            => 'isSameOrBefore',
                ],
                [
                    'field_name'          => 'undergraduate_month_year',
                    'hidden_values'       => null,
                    'default_visibility'  => false,
                    'callable'            => 'isSameOrBefore',
                ],
            ],
            'input' => [
                'field_name'          => 'immigration_status',
                'visible_values'      => $visibleImmigrationStatusesResponses,
                'hidden_values'       => null,
                'default_visibility'  => false,
            ],
        ];
    }
}
