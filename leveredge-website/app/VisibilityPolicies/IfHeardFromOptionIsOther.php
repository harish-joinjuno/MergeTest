<?php


namespace App\VisibilityPolicies;


class IfHeardFromOptionIsOther implements \App\Contracts\VisibilityPolicyInterface
{
    public function getDefinition()
    {
        $visibleHasJobStartDateResponses = [
            '1',
        ];

        return [
            'method'              => 'based-on-value-of-input-on-page',
            'field_name'          => 'heard_from_option_id',
            'visible_values'      => $visibleHasJobStartDateResponses,
            'hidden_values'       => null,
            'default_visibility'  => false,
        ];
    }
}
