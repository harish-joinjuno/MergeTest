<?php

namespace App\Nova;

use App\Definitions\MenuTypes;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class MenuLink extends Resource
{
    use HasSortableRows;

    public static $model = \App\MenuLink::class;

    public static $title = 'label';

    public static $group = 'Admin';

    public static $search = [
        'id',
        'weight',
        'label',
        'href',
        'menu',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Select::make('Menu')->options(MenuTypes::naming()),
            Text::make('Href'),
            Text::make('Label'),
            Textarea::make('Description'),
            BelongsTo::make('Parent', 'parent', MenuLink::class)->nullable(),
            Number::make('Weight')->nullable(),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }

    public static function newModel()
    {
        $model       = static::$model;
        $var         = new $model;
        $var->weight = 0;
        return $var;
    }
}
