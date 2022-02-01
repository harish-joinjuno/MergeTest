<?php


namespace App\VisibilityPolicies;


class IfHasJobStartDateYes implements \App\Contracts\VisibilityPolicyInterface
{
    public function getDefinition()
    {
        $visibleHasJobStartDateResponses = [
            '1',
        ];

        return [
            'method'              => 'based-on-value-of-input-on-page',
            'field_name'          => 'have_job_start_date',
            'visible_values'      => $visibleHasJobStartDateResponses,
            'hidden_values'       => null,
            'default_visibility'  => false,
        ];
    }
}
