<?php

namespace App;

use App\Jobs\SyncScholarshipEntrantWithMailcoachJob;
use Illuminate\Database\Eloquent\Model;
use function Illuminate\Events\queueable;

/**
 * Class ScholarshipEntrant
 * @package App
 * @property int $id
 * @property int $scholarship_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $university_id
 * @property int $degree_id
 * @property int $graduation_year
 * @property-read University $university
 * @property-read Degree $degree
 * @property Scholarship $scholarship
 * @property array $answers
 */
class ScholarshipEntrant extends Model
{
    const MAILCOACH_TAGS = ['nova', 'group-15'];

    protected $fillable = [
        'scholarship_id',
        'first_name',
        'last_name',
        'email',
        'university_id',
        'degree_id',
        'graduation_year',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    protected static function booted()
    {
        static::created(function ($entrant) {
            $listId = config('services.mailcoach_email.scholarship_list_id');
            dispatch(new SyncScholarshipEntrantWithMailcoachJob($entrant, $listId, self::MAILCOACH_TAGS));
        });
    }
}
