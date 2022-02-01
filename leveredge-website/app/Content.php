<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Content
 * @package App
 * @property int $id
 * @property string $name
 * @property string $body
 * @property int $parent_id
 * @property string $parent_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Content extends Model
{
    public function parent()
    {
        return $this->morphTo();
    }
}
