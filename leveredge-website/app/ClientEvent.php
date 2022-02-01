<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrackShareButton
 * @package App
 *
 * @property int $id
 * @property int $client_id
 * @property string $category
 * @property string $action
 * @property string $label
 * @property int $value
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Client $client
 */
class ClientEvent extends Model
{
    protected $fillable = [
        'client_id',
        'category',
        'action',
        'label',
        'value'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
