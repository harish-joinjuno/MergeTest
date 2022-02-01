<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DeleteRequest
 * @package App
 *
 * @property int $id
 * @property int $user_id
 * @property string $reason
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read User $user
 */
class DeleteRequest extends Model
{
    protected $fillable = ['reason'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
