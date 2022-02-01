<?php

namespace App;

use \App\Traits\Scholarship;
use App\Contracts\ScholarshipsInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int     $id
 * @property string  $name
 * @property int     $max_amount
 * @property string  $description
 * @property string  $link
 * @property string  $eligible_gender
 * @property boolean $citizenship_requirement
 * @property string  $eligible_states
 * @property float   $minimum_eligible_gpa
 * @property Carbon  $application_due_by
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class LawScholarship extends Model implements ScholarshipsInterface
{
    protected $fillable = [
        'name',
        'application_due_by',
        'max_amount',
        'description',
        'link',
        'eligible_gender',
        'eligible_protected_classes',
        'citizenship_requirement',
        'eligible_states',
        'minimum_eligible_gpa',
    ];

    protected $casts = [
        'application_due_by'         => 'date:F d, Y',
        'minimum_eligible_gpa'       => 'decimal:2',
        'eligible_protected_classes' => 'array',
        'eligible_states'            => 'array',
    ];

    protected $appends = [
        'recommended',
        'application_due_by_now',
        'max_amount_value',
    ];

    public function getRecommendedAttribute()
    {
        return 0;
    }

    public function getApplicationDueByNowAttribute()
    {
        if (! is_null($this->attributes['application_due_by'])) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['application_due_by'])->timestamp;
        }
    }

    public function getMaxAmountValueAttribute()
    {
        return (int)preg_replace('/[^\d.]/', '', $this->attributes['max_amount']);
    }
}
