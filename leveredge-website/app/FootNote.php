<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FootNote
 * @package App
 * @property int $id
 * @property string $name
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class FootNote extends Model
{
    use SoftDeletes;

    const EARNEST_SLO_TERM_FOOTNOTE         = 1;
    const EARNEST_SLO_APR_FOOTNOTE          = 2;
    const EARNEST_SLO_AUTO_PAY_FOOTNOTE     = 3;
    const EARNEST_SLO_GRACE_PERIOD_FOOTNOTE = 4;
    const EARNEST_SLO_NO_FEES_FOOTNOTE      = 5;
    const EARNEST_SLO_GRAD_APR_FOOTNOTE     = 6;
}
