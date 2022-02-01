<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class ScholarshipWinner
 * @package App
 * @property int $id
 * @property int $scholarship_id
 * @property-read Scholarship $scholarship
 * @property string $title
 * @property string $name
 * @property string $photo
 * @property string $university
 * @property string $year
 */
class ScholarshipWinner extends Model
{
    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }

    public function getPhotoAttribute($value)
    {
        return Storage::disk('s3_app_public')->url($value);
    }
}
