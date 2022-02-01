<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialProvider
 * @package App
 *
 * @property string $name
 */
class SocialProvider extends Model
{
    const FACEBOOK_PROVIDER_ID = 1;
    const GOOGLE_PROVIDER_ID   = 2;
    const DOXIMITY_PROVIDER_ID = 3;
}
