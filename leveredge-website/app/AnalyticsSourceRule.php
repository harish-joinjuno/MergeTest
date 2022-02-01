<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * Class AnalyticsSourceRule
 * @package App
 * @property int $id
 * @property string|null $utm_source
 * @property string|null $utm_medium
 * @property string|null $utm_campaign
 * @property string|null $utm_term
 * @property string|null $utm_content
 * @property bool|null $gclid_exists
 * @property bool|null $referred_by_id_exists
 * @property bool|null $referred_by_user_is_partner
 * @property bool|null $referred_by_user_is_member
 * @property int|null $heard_from_option_id
 * @property int $sort_order
 * @property int $analytics_source_id
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class AnalyticsSourceRule extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name'  => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'gclid_exists',
        'referred_by_id_exists',
        'heard_from_option_id',
        'analytics_source_id',
        'sort_order',
    ];

    /**
     * @param User $user
     * @return bool
     */
    public function matches(User $user)
    {
        if ($this->referred_by_id_exists && is_null($user->referred_by_id)) {
            return false;
        }

        if ($this->referred_by_user_is_member) {
            $is_member = UserProfile::where('user_id',$user->referredBy->id)->exists();
            if (!$is_member) {
                return false;
            }
        }

        if ($this->referred_by_user_is_partner) {
            $is_partner = PartnerProfile::where('user_id',$user->referredBy->id)->exists();
            if (!$is_partner) {
                return false;
            }
        }

        if ($this->gclid_exists && is_null($user->profile->gclid)) {
            return false;
        }

        $attributes_on_profile = [
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
            'heard_from_option_id',
        ];

        foreach ($attributes_on_profile as $attribute) {
            if (!is_null($this->$attribute) && $this->$attribute != $user->profile->$attribute) {
                return false;
            }
        }

        return true;
    }
}
