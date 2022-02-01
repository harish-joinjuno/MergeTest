<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CareerOneStopScholarship
 * @package App
 * @property int $id
 * @property int $career_one_stop_id
 * @property string $name
 * @property string $organization
 * @property string $phone_number
 * @property string $email
 * @property string $fax_number
 * @property string $level_of_study
 * @property string $award_type
 * @property string $purpose
 * @property string $focus
 * @property string $qualifications
 * @property string $criteria
 * @property string $funds
 * @property string $duration
 * @property string $number_of_awards
 * @property string $to_apply
 * @property string $deadline
 * @property string $contact
 * @property string $for_more_information
 * @property string $formatted_deadline
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CareerOneStopScholarship extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'career_one_stop_id',
    ];

    protected $appends = [
        'formatted_deadline',
        'formatted_deadline_timestamp',
        'funds_value',
    ];

    public function getFormattedDeadlineAttribute()
    {
        if (! empty($this->deadline) && date_create($this->deadline)) {
            return date_format(date_create($this->deadline),'F d, Y');
        }

        return null;
    }

    public function getFormattedDeadlineTimestampAttribute()
    {
        if (! empty($this->formatted_deadline)) {
            return Carbon::createFromFormat('F d, Y', $this->formatted_deadline)->timestamp;
        }

        return null;
    }

    public function getFundsValueAttribute()
    {
        if ($this->attributes['funds']) {
            $amounts = explode('$', $this->attributes['funds']);
            $count   = count($amounts);
            if ($count) {
                return (float)str_replace(',', '', $amounts[$count - 1]);
            }
        }

        return 0;
    }
}
