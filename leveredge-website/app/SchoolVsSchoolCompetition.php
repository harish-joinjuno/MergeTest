<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int university_id_one
 * @property string colloquial_name_one
 * @property string colloquial_slug_one
 * @property int university_id_two
 * @property string colloquial_name_two
 * @property string colloquial_slug_two
 * @property int first_prize_amount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read University $university_one
 * @property-read University $university_two
 * @property-read Degree $degree_one
 * @property-read Degree $degree_two
 * @property int $target_number_of_students
 * @property int $number_of_prizes
 * @property string $hero_image
 * @property string $logo_one
 * @property string $logo_two
 * @property array $true_statements
 */
class SchoolVsSchoolCompetition extends Model
{
    protected $appends = ['colloquial_slug_one', 'colloquial_slug_two'];

    protected $casts = [
        'true_statements' => 'array',
    ];

    public function universityOne(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(University::class,'university_id_one');
    }

    public function universityTwo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(University::class,'university_id_two');
    }

    public function entrants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SchoolVsSchoolCompetitionEntrant::class);
    }

    public function getColloquialSlugOneAttribute(): string
    {
        return Str::slug($this->colloquial_name_one);
    }

    public function getColloquialSlugTwoAttribute(): string
    {
        return Str::slug($this->colloquial_name_two);
    }

    public function setTrueStatementsAttribute($value)
    {
        if ($value === "[]") {
            $this->attributes['true_statements'] = '[]';
        } else {
            $this->attributes['true_statements'] = json_encode($value);
        }
    }

    public function getLogoOneAttribute($value)
    {
        return Storage::disk('s3_public')->url($value);
    }

    public function getLogoTwoAttribute($value)
    {
        return Storage::disk('s3_public')->url($value);
    }
}
