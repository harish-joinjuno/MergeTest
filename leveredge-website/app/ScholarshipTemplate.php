<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ScholarshipTemplate
 * @package App
 * @property int $id
 * @property string $name
 * @property string $view
 * @property string $success_view
 * @property-read Scholarship[] $scholarships
 */
class ScholarshipTemplate extends Model
{
    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }
}
