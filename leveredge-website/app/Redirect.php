<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Redirect
 * @package App
 * @property int $id
 * @property string $from
 * @property string $to
 * @property string $method
 * @property int $code
 * @property bool $with_query_parameters
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Redirect extends Model
{
    protected $fillable = [
        'from',
        'to',
        'method',
        'code',
        'with_query_parameters'
    ];
}
