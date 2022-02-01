<?php

namespace App;

use App\Contracts\DisplayCountAndProgressStageInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int     $id
 * @property string  $name
 * @property bool    $refinance
 * @property int     $display_priority
 * @property string  $display_name
 * @property string  $dashboard_update
 * @property int     $display_count_based_on
 * @property array   $progress_titles
 * @property array   $progress_descriptions
 * @property int     $progress_stage
 * @property string  $dashboard_button_cta
 * @property boolean $hide_dashboard_button
 * @property Carbon  $starts_on
 * @property Carbon  $ends_on
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 *
 * @property-read Collection|NegotiationGroup[] $negotiationGroups
 * @property-read Collection|User[] $users
 */
class AcademicYear extends Model implements DisplayCountAndProgressStageInterface
{
    use SoftDeletes;

    const ACADEMIC_YEAR_REFINANCE = 'refinance';

    const ACADEMIC_YEAR_20_21     = 'Academic Year 2020-21';

    const ACADEMIC_YEAR_HEALTH_INSURANCE = 'Health Insurance';



    const ACADEMIC_YEAR_BAR_PREP = 'Bar Prep';

    const ACADEMIC_YEAR_REFINANCE_ID          = 1;
    const ACADEMIC_YEAR_SPRING_WINTER_2020_ID = 2;
    const ACADEMIC_YEAR_2020_2021_ID          = 3;
    const ACADEMIC_YEAR_HEALTH_INSURANCE_ID   = 4;
    const ACADEMIC_YEAR_AUTO_REFI_ID          = 5;
    const ACADEMIC_YEAR_BAR_PREP_ID           = 6;
    const ACADEMIC_YEAR_FALL_21_AND_BEYOND_ID = 7;
    const ACADEMIC_YEAR_COLLEGE_TEST_PREP_ID  = 8;

    protected $fillable = [
        'name',
        'starts_on',
        'ends_on',
        'display_priority',
        'display_name',
        'dashboard_update',
        'display_count_based_on',
        'progress_titles',
        'progress_descriptions',
        'progress_stage',
    ];

    protected $casts = [
        'refinance'             => 'bool',
        'starts_on'             => 'date',
        'ends_on'               => 'date',
        'progress_titles'       => 'array',
        'progress_descriptions' => 'array',
        'hide_dashboard_button' => 'boolean',
    ];

    public function negotiationGroups()
    {
        $relation = $this->hasMany(NegotiationGroup::class);
        $relation->orderBy('priority', 'asc');

        return $relation;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'negotiation_group_users', 'academic_year_id', 'user_id');
    }

    public function getDisplayNameAttribute($value)
    {
        if (! $value) {
            return $this->name . ' student loan negotiation group';
        }

        return $value;
    }

    public function getProgressTitlesAttribute($value)
    {
        if (is_null($value)) {
            return json_decode('["","",""]');
        }

        return json_decode($value);
    }

    public function getProgressDescriptionsAttribute($value)
    {
        if (is_null($value)) {
            return json_decode('["","",""]');
        }

        return json_decode($value);
    }

    public function getProgressStageAttribute($value)
    {
        if (is_null($value)) {
            return self::PROGRESS_STAGE_STEP_ONE_COMPLETE;
        }

        return $value;
    }

    public function getUsersCountAttribute()
    {
        $usersCount = NegotiationGroupUser::where('academic_year_id',$this->id)->count();

        if ($this->id === AcademicYear::ACADEMIC_YEAR_AUTO_REFI_ID) {
            return $usersCount + 351;
        }

        return $usersCount;
    }
}
