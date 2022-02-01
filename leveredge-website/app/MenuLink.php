<?php

namespace App;

use App\Events\MenuLinkChanged;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property int    $id
 * @property int    $weight
 * @property int    $parent_id
 * @property string $menu
 * @property string $href
 * @property string $label
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MenuLink extends Model implements Sortable
{
    use SortableTrait;

    protected $fillable = [
        'id',
        'weight',
        'menu',
        'href',
        'label',
        'parent_id',
    ];

    protected $dispatchesEvents = [
        'saved'   => MenuLinkChanged::class,
        'deleted' => MenuLinkChanged::class,
    ];

    public $sortable = [
        'order_column_name'  => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }

    public function getHrefAttribute($value)
    {
        return ($value) ? url($value) : null;
    }

    public function parent()
    {
        return $this->belongsTo(MenuLink::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(MenuLink::class, 'parent_id', 'id')->orderBy('sort_order', 'asc');
    }

    public function getProductLinks()
    {
        return Cache::rememberForever('menuLinks:products', function () {
            return self::where('menu', '=', 'products')
                ->get(['href', 'label'])
                ->toArray();
        });
    }

    public function getCompanyLinks()
    {
        return Cache::rememberForever('menuLinks:company', function () {
            return self::where('menu', '=', 'company')
                ->get(['href', 'label'])
                ->toArray();
        });
    }

    public function getCopyrightLinks()
    {
        return Cache::rememberForever('menuLinks:copyright', function () {
            return self::where('menu', '=', 'copyright')
                ->get(['href', 'label'])
                ->toArray();
        });
    }

    public function getParentLinks()
    {
        return Cache::rememberForever('menuLinks:header', function () {
            return self::where('menu', '=', 'header')
                ->whereNull('parent_id')
                ->with('children')
                ->orderBy('sort_order')
                ->get();
        });
    }

    public function getAuthDropdownLinks()
    {
        return Cache::rememberForever('menuLinks:auth_dropdown', function () {
            return self::where('menu', '=', 'auth_dropdown')
                ->whereNull('parent_id')
                ->with('children')
                ->get();
        });
    }
}
