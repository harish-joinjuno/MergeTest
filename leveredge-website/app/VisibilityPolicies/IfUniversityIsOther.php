<?php


namespace App\VisibilityPolicies;


use App\University;

class IfUniversityIsOther implements \App\Contracts\VisibilityPolicyInterface
{
    public function getDefinition()
    {
        $visibleUniversityResponses = [
            University::OTHER,
        ];

        return [
            'method'              => 'based-on-value-of-input-on-page',
            'field_name'          => 'university_id',
            'visible_values'      => $visibleUniversityResponses,
            'hidden_values'       => null,
            'default_visibility'  => false,
        ];
    }
}
