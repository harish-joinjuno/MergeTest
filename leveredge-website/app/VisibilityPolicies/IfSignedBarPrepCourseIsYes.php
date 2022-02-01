<?php


namespace App\VisibilityPolicies;

class IfSignedBarPrepCourseIsYes implements \App\Contracts\VisibilityPolicyInterface
{
    public function getDefinition()
    {
        $visibleSignedBarPrepCourseResponses = [
            'Yes, paid a deposit',
            'Yes, paid in full',
        ];

        return [
            'method'              => 'based-on-value-of-input-on-page',
            'field_name'          => 'bar_prep_sign_up',
            'visible_values'      => $visibleSignedBarPrepCourseResponses,
            'hidden_values'       => null,
            'default_visibility'  => false,
        ];
    }
}
