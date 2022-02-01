<?php

namespace App;

use App\Contracts\DisplayCountAndProgressStageInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int     $id
 * @property int     $academic_year_id
 * @property string  $name
 * @property string  $slug
 * @property int     $priority
 * @property int     $deal_confidence
 * @property string  $display_name
 * @property string  $redirect_url
 * @property string  $dashboard_update
 * @property int     $display_count_based_on
 * @property array   $progress_titles
 * @property array   $progress_descriptions
 * @property int     $progress_stage
 * @property string  $dashboard_button_cta
 * @property boolean $hide_dashboard_button
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 *
 * @property-read Collection|NegotiationGroupAnnouncement[] $announcements
 * @property-read Collection|NegotiationGroupEligibleProfile $eligibleProfiles
 * @property-read Collection|NegotiationGroupFaqCategory $faqCategories
 * @property-read AcademicYear $academicYear
 * @property-read Collection|User[] $users
 * @property-read MailchimpAutomatedCampaignMailable $mailable
 */
class NegotiationGroup extends Model implements DisplayCountAndProgressStageInterface
{
    use SoftDeletes;

    const NG_INTERNATIONAL_REFINANCE        = 1;

    const NG_DOMESTIC_CB_ELIGIBLE           = 8;
    const NG_DOMESTIC_NON_CB_GRAD           = 9;
    const NG_DOMESTIC_UNDERGRAD             = 10;
    const NG_INTERNATIONAL_WITH_US_COSIGNER = 11;
    const NG_INTERNATIONAL_AT_DISCOVER      = 12;
    const NG_INTERNATIONAL_AT_NON_DISCOVER  = 13;

    const NG_MEDICAL_IN_FR_CITIES          = 14;
    const NG_MEDICAL_OUTSIDE_FR_CITIES     = 15;
    const NG_NON_MEDICAL_IN_FR_CITIES      = 16;
    const NG_NON_MEDICAL_OUTSIDE_FR_CITIES = 17;
    const NG_DOMESTIC_REFINANCE            = 2;

    const NG_ELIGIBLE_FOR_GBG_HEALTH_INSURANCE     = 18;
    const NG_NOT_ELIGIBLE_FOR_GBG_HEALTH_INSURANCE = 19;

    const NG_GENERAL_AUTO_REFI = 20;
    const NG_BAR_PREP_ID       = 21;

    const NG_DOMESTIC_GROUP_21_22      = 22;
    const NG_INTERNATIONAL_GROUP_21_22 = 23;
    const NG_SAT_ACT_PREP_ID           = 24;
    const NG_AUTO_REFI_NON_ELIGIBLE_ID = 25;
    const NG_MBA_21_22                 = 26;
    const NG_GRAD_21_22                = 27;

    const AUTO_REFI_NEGOTIATION_GROUPS = [self::NG_AUTO_REFI_NON_ELIGIBLE_ID];

    protected $casts = [
        'progress_titles'       => 'array',
        'progress_descriptions' => 'array',
        'hide_dashboard_button' => 'boolean',
    ];

    protected $appends = [
        'users_count',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function announcements()
    {
        return $this->hasMany(NegotiationGroupAnnouncement::class);
    }

    public function faqCategories()
    {
        return $this->hasMany(NegotiationGroupFaqCategory::class);
    }

    public function eligibleProfiles()
    {
        return $this->hasMany(NegotiationGroupEligibleProfile::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'negotiation_group_users', 'negotiation_group_id', 'user_id');
    }

    public function endScreen()
    {
        return $this->hasOne(NegotiationGroupEndScreen::class, 'negotiation_group_id');
    }

    protected static function booted()
    {
        static::addGlobalScope('priority', function (Builder $builder) {
            $builder->orderBy('priority', 'asc');
        });
    }

    public function getDisplayNameAttribute($value)
    {
        if (! $value) {
            return $this->academicYear->display_name;
        }

        return $value;
    }

    public function getDashboardUpdateAttribute($value)
    {
        if (! $value) {
            return $this->academicYear->dashboard_update;
        }

        return $value;
    }

    public function getDisplayCountBasedOnAttribute($value)
    {
        if (! $value) {
            return $this->academicYear->display_count_based_on;
        }

        return $value;
    }

    public function getProgressTitlesAttribute($value)
    {
        if (! $value) {
            return $this->academicYear->progress_titles;
        }

        return json_decode($value);
    }

    public function getProgressDescriptionsAttribute($value)
    {
        if (! $value) {
            return $this->academicYear->progress_descriptions;
        }

        return json_decode($value);
    }

    public function getProgressStageAttribute($value)
    {
        if (! $value) {
            return $this->academicYear->progress_stage;
        }

        return $value;
    }

    public function getUsersCountAttribute()
    {
        if ($this->display_count_based_on === self::DISPLAY_COUNT_BASED_ON_ACADEMIC_YEARS && $this->academicYear) {
            $usersCount = NegotiationGroupUser::where('academic_year_id',$this->academicYear->id)->count();

            if ($this->academic_year_id === AcademicYear::ACADEMIC_YEAR_AUTO_REFI_ID) {
                return $usersCount + 351;
            }

            return $usersCount;
        }

        $usersCount = NegotiationGroupUser::where('negotiation_group_id',$this->id)->count();

        if ($this->academic_year_id === AcademicYear::ACADEMIC_YEAR_AUTO_REFI_ID) {
            return $usersCount + 351;
        }

        return $usersCount;
    }

    public function getDashboardButtonCtaAttribute($value)
    {
        if (! $value) {
            return $this->academicYear->dashboard_button_cta;
        }

        return $value;
    }

    public function getHideDashboardButtonAttribute($value)
    {
        if (is_null($value)) {
            return $this->academicYear->hide_dashboard_button;
        }

        return $value;
    }

    public function mailable()
    {
        return $this->morphOne(MailchimpAutomatedCampaignMailable::class, 'mailable');
    }
}
