<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $original_name
 * @property string $size
 * @property string $path
 * @property string $fileable_type
 * @property int    $fileable_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read $files
 */
class File extends Model
{
    protected $fillable = [
        'name',
        'original_name',
        'size',
        'path',
        'fileable_type',
        'fileable_id',
    ];

    protected $appends = [
        'original_name_truncated',
    ];

    public function files()
    {
        return $this->morphTo('fileable');
    }

    public function getOriginalNameTruncatedAttribute()
    {
        return Str::limit($this->original_name, 30);
    }
}
