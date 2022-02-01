<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class AutoRefinanceApplication
 * @package App
 * @property int $id
 * @property int $client_id
 * @property int $user_id
 * @property int $experiment_id
 * @property string $vin
 * @property string $license_plate
 * @property string $license_plate_state
 * @property string $vehicle_model
 * @property string $vehicle_make
 * @property string $vehicle_year
 * Payment
 * @property string $payoff_amount
 * @property string $monthly_payment
 * @property string $mileage
 * Personal
 * @property string $first_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $email
 * Housing
 * @property string $street_address
 * @property string $street_address_2
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $residence_ownership
 * @property string $stay_duration
 * @property string $housing_payment
 * Employment
 * @property string $employment_status
 * @property string $yearly_pre_tax_income
 * @property string $work_duration
 * @property bool $completed_application
 * @property float $original_loan_interest_rate
 * @property int $payoff_amount_below
 * @property int $income
 * @property string $credit_score
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class AutoRefinanceApplication extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
