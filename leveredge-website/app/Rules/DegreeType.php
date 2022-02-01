<?php

namespace App\Rules;

use App\Degree;
use Illuminate\Contracts\Validation\Rule;

class DegreeType implements Rule
{
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function passes($attribute, $value)
    {
        return Degree::query()
            ->where('id', '=', $value)
            ->where('type', '=', $this->type)->exists();
    }

    public function message()
    {
        return trans('validation.degree_type');
    }
}
