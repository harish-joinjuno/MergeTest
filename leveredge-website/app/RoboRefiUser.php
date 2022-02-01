<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoboRefiUser extends Model
{
    protected $fillable = [
        'email',
    ];

    protected $appends = [
        'referral_link',
        'success_link',
    ];

    public function getReferralLinkAttribute()
    {
        return url('/robo-refi?r=' . $this->id);
    }

    public function getSuccessLinkAttribute()
    {
        return url('/robo-refi/success/' . $this->id);
    }
}
