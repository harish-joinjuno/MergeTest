<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int             $id
 * @property int             $referral_program_id
 * @property int             $university_id
 * @property int             $degree_id
 * @property int             $grad_degree_id
 * @property int             $grad_university_id
 * @property string          $immigration_status
 * @property Carbon          $created_on_or_after
 * @property Carbon          $created_before
 * @property Carbon          $created_at
 * @property Carbon          $updated_at
 * @property ReferralProgram $referralProgram
 * @property University      $gradUniversity
 * @property Degree          $gradDegree
 * @property University      $university
 * @property Degree          $degree
 */
class ReferralProgramEligibleProfile extends Model
{
    protected $casts = [
        'created_on_or_after' => 'date',
        'created_before'      => 'date',
    ];

    public function referralProgram()
    {
        return $this->belongsTo(ReferralProgram::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function gradUniversity()
    {
        return $this->belongsTo(University::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function gradDegree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function matches(UserProfile $userProfile)
    {
        if ($this->university_id && $this->university_id != $userProfile->university_id) {
            return false;
        }

        if ($this->degree_id && $this->degree_id != $userProfile->degree_id) {
            return false;
        }

        if ($this->grad_university_id && $this->grad_university_id != $userProfile->grad_university_id) {
            return false;
        }

        if ($this->grad_degree_id && $this->grad_degree_id != $userProfile->grad_degree_id) {
            return false;
        }

        if ($this->immigration_status && $this->immigration_status != $userProfile->immigration_status) {
            return false;
        }

        if ($this->created_on_or_after && $this->created_on_or_after > $userProfile->created_at) {
            return false;
        }

        if ($this->created_before && $this->created_before <= $userProfile->created_at) {
            return false;
        }

        return true;
    }
}
