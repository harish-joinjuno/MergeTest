<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSocial
 * @package App
 *
 * @property int $id
 * @property string unique_id_from_provider
 * @property int $social_provider_id
 * @property boolean $email_provided
 * @property object $user_data
 */
class UserSocial extends Model
{
    protected $fillable = [
        'unique_id_from_provider',
        'user_id',
        'social_provider_id',
        'email_provided',
        'user_data',
    ];

    protected $casts = [
        'user_data' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
