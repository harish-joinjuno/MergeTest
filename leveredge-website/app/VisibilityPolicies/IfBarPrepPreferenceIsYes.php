<?php


namespace App\VisibilityPolicies;


class IfBarPrepPreferenceIsYes implements \App\Contracts\VisibilityPolicyInterface
{

    public function getDefinition()
    {
        $visibleBarPrepPreferenceResponses = [
            'Yes',
        ];

        return [
            'method'              => 'based-on-value-of-input-on-page',
            'field_name'          => 'bar_prep_company_preference',
            'visible_values'      => $visibleBarPrepPreferenceResponses,
            'hidden_values'       => null,
            'default_visibility'  => false,
        ];
    }
}
