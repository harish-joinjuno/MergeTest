<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $full_name
 * @property string $street_address
 * @property string $email
 * @property string $phone_number
 * @property string $citizenship
 * @property int    $credit_score
 * @property string $education_degree_type
 * @property string $education_school_name
 * @property int    $education_expected_graduation_year
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class BoldStudent extends Model
{
    //
}
