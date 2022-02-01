<?php


namespace App\VisibilityPolicies;

class IfCurrentlyEmployedIsNo implements \App\Contracts\VisibilityPolicyInterface
{
    public function getDefinition()
    {
        $visibleCurrentlyEmployedResponses = [
            '0',
        ];

        return [
            'method'              => 'based-on-value-of-input-on-page',
            'field_name'          => 'is_currently_employed',
            'visible_values'      => $visibleCurrentlyEmployedResponses,
            'hidden_values'       => null,
            'default_visibility'  => false,
        ];
    }
}
