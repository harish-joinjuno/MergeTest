<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FederalSchoolData
 * @package App
 * @property int $id
 * @property int $university_id
 * @property int $opeid
 * @property string $institution_name
 * @property int $full_time_enrollment
 * @property float $percentage_using_private
 * @property int $total_private_borrowing
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class FederalSchoolData extends Model
{
    //
}
