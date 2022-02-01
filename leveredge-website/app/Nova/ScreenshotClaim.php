<?php

namespace App\Nova;

use App\Nova\Actions\PayMemberForClaim;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ScreenshotClaim extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\ScreenshotClaim::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User')
                ->searchable()
                ->required(),

            BelongsTo::make('Payment Method', 'paymentMethod')
                ->required(),

            BelongsTo::make('Payment')
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->nullable(),

            Number::make('Amount', 'amount')
                ->required(),

            Boolean::make('Is Paid', 'payment_completed')
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->nullable(),

            Text::make('Status', 'status')
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->nullable(),

            MorphOne::make('File', 'file'),
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
        $screenshotClaim = \App\ScreenshotClaim::find($request->resourceId);

        $action          = new PayMemberForClaim();
        if ($screenshotClaim && $screenshotClaim->amount > 1000) {
            $action->confirmText("This payment is larger than $1000. Are you sure you want to make this payment?");
        }

        return [
            $action,
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->select('screenshot_claims.*','u.name', 'u.email');
        $query->join('users as u', 'screenshot_claims.user_id', '=', 'u.id');

        return $query;
    }

    public function title()
    {
        return "Claim on " . $this->created_at->format('m-d-Y');
    }
}
