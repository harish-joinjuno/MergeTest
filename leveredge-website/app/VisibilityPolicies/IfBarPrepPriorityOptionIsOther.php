<?php


namespace App\VisibilityPolicies;


class IfBarPrepPriorityOptionIsOther implements \App\Contracts\VisibilityPolicyInterface
{

    public function getDefinition()
    {
        $visibleBarPrepPriorityCourseResponses = [
            'Other',
        ];

        return [
            'method'              => 'based-on-value-of-input-on-page',
            'field_name'          => 'bar_prep_priority',
            'visible_values'      => $visibleBarPrepPriorityCourseResponses,
            'hidden_values'       => null,
            'default_visibility'  => false,
        ];
    }
}
