<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property int    $id
 * @property string $name
 * @property string $description
 * @property int    $priority
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Role extends Model implements Sortable
{
    use SortableTrait;

    const ROLE_BORROWER              = 1;
    const ROLE_LENDER                = 2;
    const ROLE_ADMIN                 = 3;
    const ROLE_PARTNER               = 4;
    const ROLE_NOVA_USER             = 5;
    const ROLE_REFERRAL_PROGRAM_USER = 6;

    const ROLE_NAME_ADMIN                 = 'admin';
    const ROLE_NAME_LENDER                = 'lender';
    const ROLE_NAME_PARTNER               = 'partner';
    const ROLE_NAME_BORROWER              = 'borrower';
    const ROLE_NAME_NOVA_USER             = 'nova-user';
    const ROLE_NAME_REFERRAL_PROGRAM_USER = 'referral-program-user';

    public $sortable = [
        'order_column_name'  => 'priority',
        'sort_when_creating' => true,
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function findByName(string $name)
    {
        /** @var Role $role */
        $role = Role::query()
            ->where('name', '=', $name)
            ->firstOrFail();

        return $role;
    }
}
