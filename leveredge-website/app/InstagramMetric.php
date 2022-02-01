<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $posts_count
 * @property int $followers_count
 * @property int $following_count
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class InstagramMetric extends Model
{
    protected $fillable = [
        'posts_count',
        'followers_count',
        'following_count',
    ];
}
