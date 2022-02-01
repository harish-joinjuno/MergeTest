<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * @property int $id
 * @property int $negotiation_group_id
 * @property int $university_id
 * @property int $degree_id
 * @property int $grad_degree_id
 * @property int $grad_university_id
 * @property int $annual_income_min
 * @property int $annual_income_max
 * @property string $immigration_status
 * @property string $credit_score
 * @property string $cosigner_status
 * @property string $cosigner_immigration_status
 * @property bool $is_undergrad_student
 * @property bool $is_grad_student
 * @property string $zip_code
 * @property bool $is_medical
 * @property int $minimum_loan_amount
 * @property int $maximum_loan_amount
 * @property float $original_loan_interest_rate
 * @property int $vehicle_year
 * @property int $payoff_amount_below
 * @property int $income_below
 * @property bool $has_graduated
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property-read NegotiationGroup $negotiationGroup
 * @property-read University $gradUniversity
 * @property-read Degree $gradDegree
 * @property-read University $university
 * @property-read Degree $degree
 */
class NegotiationGroupEligibleProfile extends Model
{
    use SoftDeletes;

    protected $fillable = [
         'negotiation_group_id',
         'university_id',
         'degree_id',
         'grad_degree_id',
         'grad_university_id',
         'annual_income_min',
         'annual_income_max',
         'immigration_status',
         'credit_score',
         'cosigner_status',
         'cosigner_immigration_status',
         'is_undergrad_student',
         'is_grad_student',
         'zip_code',
         'is_medical',
         'minimum_loan_amount',
         'maximum_loan_amount',
    ];

    public function negotiationGroup()
    {
        return $this->belongsTo(NegotiationGroup::class);
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

        if ($this->credit_score && $this->credit_score != $userProfile->credit_score) {
            return false;
        }

        if ($this->annual_income_min && $userProfile->annual_income < $this->annual_income_min) {
            return false;
        }

        if ($this->annual_income_max && $userProfile->annual_income > $this->annual_income_max) {
            return false;
        }

        if ($this->cosigner_status && $userProfile->cosigner_status != $this->cosigner_status) {
            return false;
        }

        if ($this->cosigner_immigration_status && $userProfile->cosigner_immigration_status != $this->cosigner_immigration_status) {
            return false;
        }

        if ($this->is_undergrad_student && !$userProfile->isUndergradStudent()) {
            return false;
        }

        if ($this->is_grad_student && !$userProfile->isGradStudent()) {
            return false;
        }

        if ($this->zip_code && $this->zip_code != $userProfile->zip_code) {
            return false;
        }

        if ($this->is_medical && $this->is_medical != $userProfile->is_medical) {
            return false;
        }

        if ($this->maximum_loan_amount !== null || $this->minimum_loan_amount !== null) {
            /** @var NegotiationGroupUser $negotiationGroupUser */
            $negotiationGroupUser = NegotiationGroupUser::whereIn('negotiation_group_id',$this->negotiationGroup->academicYear->negotiationGroups->pluck('id'))
                ->where('user_id',$userProfile->user->id)->first();

            if (!$negotiationGroupUser) {
                return false;
            }

            if ($this->minimum_loan_amount && $this->minimum_loan_amount > $negotiationGroupUser->amount) {
                return false;
            }

            if ($this->maximum_loan_amount && $this->maximum_loan_amount < $negotiationGroupUser->amount) {
                return false;
            }
        }

        if ($this->has_graduated && $userProfile->grad_graduation_year > now()->year) {
            return false;
        }

        if ($this->has_graduated && $userProfile->graduation_year > now()->year) {
            return false;
        }

        if ( NegotiationGroupUserExclusion::where('user_id', $userProfile->user->id )
            ->where('negotiation_group_id',$this->negotiation_group_id)->exists() ) {
            return false;
        }
        if (in_array($this->negotiation_group_id, NegotiationGroup::AUTO_REFI_NEGOTIATION_GROUPS)) {
            /** @var AutoRefinanceApplication $latestAutoRefinanceApplication */
            $latestAutoRefinanceApplication = $userProfile->user->autoRefinanceApplications()->orderByDesc('created_at')->first();

            if ($latestAutoRefinanceApplication) {

                if ($this->credit_score) {
                    if ($this->credit_score != $latestAutoRefinanceApplication->credit_score || is_null($latestAutoRefinanceApplication->credit_score)) {
                        return false;
                    }
                }

                if ($this->original_loan_interest_rate) {
                    if ((float)$latestAutoRefinanceApplication->original_loan_interest_rate >= (float)$this->original_loan_interest_rate || is_null($latestAutoRefinanceApplication->original_loan_interest_rate)) {
                        return false;
                    }
                }

                if ($this->vehicle_year) {
                    if ($latestAutoRefinanceApplication->vehicle_year >= $this->vehicle_year || is_null($latestAutoRefinanceApplication->vehicle_year)) {
                        return false;
                    }
                }

                if ($this->payoff_amount_below) {
                    if ($latestAutoRefinanceApplication->payoff_amount >= $this->payoff_amount_below || is_null($latestAutoRefinanceApplication->payoff_amount)) {
                        return false;
                    }
                }

                if ($this->income_below) {
                    if ($latestAutoRefinanceApplication->yearly_pre_tax_income >= $this->income_below || is_null($latestAutoRefinanceApplication->yearly_pre_tax_income)) {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }

        return true;
    }
}
