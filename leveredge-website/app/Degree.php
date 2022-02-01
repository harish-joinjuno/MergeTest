<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Degree extends Model
{
    const TYPE_GRADUATE      = 'graduate';
    const TYPE_UNDERGRADUATE = 'undergraduate';

    protected $fillable = [
        'name',
        'type',
    ];

    public function scopeUndergraduate($query)
    {
        return $query->where('type', static::TYPE_UNDERGRADUATE);
    }

    public function scopeGraduate($query)
    {
        return $query->where('type', static::TYPE_GRADUATE);
    }

    public function getUndergraduateOrderedByName()
    {
        return $this->query()
            ->undergraduate()
            ->orderBy('name')
            ->get();
    }

    public function getGraduateOrderedByName()
    {
        return $this->query()
            ->graduate()
            ->orderBy('name')
            ->get();
    }
}
