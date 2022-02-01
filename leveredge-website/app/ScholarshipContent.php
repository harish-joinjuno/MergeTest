<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ScholarshipContent
 * @package App
 * @property int $id
 * @property int $scholarship_id
 * @property-read Scholarship $scholarship
 * @property string $type
 * @property string $name
 * @property string $body
 */
class ScholarshipContent extends Model
{
    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }
}
