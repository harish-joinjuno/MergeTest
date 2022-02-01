<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

/**
 * Class MagicLoginLink
 * @package App
 * @property int $id
 * @property string $slug
 * @property string $redirects_to
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class MagicLoginLink extends Model
{
    use SoftDeletes;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLinkForUser(User $user)
    {
        return URL::signedRoute('magic-login-link',
            [
                'user'           => $user->getRouteKey(),
                'magicLoginLink' => $this->getRouteKey(),
            ]
        );
    }
}
