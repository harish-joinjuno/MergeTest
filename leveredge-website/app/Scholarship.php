<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Scholarship
 * @package App
 * @property int $id
 * @property int $scholarship_template_id
 * @property string $name
 * @property string $slug
 * @property-read ScholarshipTemplate $scholarshipTemplate
 * @property-read ScholarshipQuestion[]|Collection $scholarshipQuestions
 * @property-read ScholarshipWinner[]|Collection $scholarshipWinners
 * @property-read ScholarshipContent[]|Collection $scholarshipContents
 * @property-read ScholarshipEntrant[]|Collection $scholarshipEntrants
 * @property-read ScholarshipEmail[]|Collection $scholarshipEmails
 */
class Scholarship extends Model
{

    protected $appends = [
        'url',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scholarshipTemplate()
    {
        return $this->belongsTo(ScholarshipTemplate::class);
    }

    public function scholarshipQuestions()
    {
        return $this->hasMany(ScholarshipQuestion::class)->orderBy('sort_order','asc');
    }

    public function scholarshipWinners()
    {
        return $this->hasMany(ScholarshipWinner::class);
    }

    public function scholarshipContents()
    {
        return $this->hasMany(ScholarshipContent::class);
    }

    public function scholarshipEntrants()
    {
        return $this->hasMany(ScholarshipEntrant::class);
    }

    public function getUrlAttribute()
    {
        return url('scholarship/' . $this->slug);
    }

    public function scholarshipEmails()
    {
        return $this->hasMany(ScholarshipEmail::class);
    }
}
