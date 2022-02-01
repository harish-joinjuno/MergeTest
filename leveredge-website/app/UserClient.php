<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserClient
 * @package App
 * @property int $user_id
 * @property int $client_id
 * @property User $user
 * @property Client $client
 * @property-read Collection $userClients
 */
class UserClient extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
