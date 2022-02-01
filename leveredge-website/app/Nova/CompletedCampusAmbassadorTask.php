<?php

namespace App\Nova;

use App\Nova\Actions\PayCampusAmbassadorForCompletedTask;
use App\PartnerType;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class CompletedCampusAmbassadorTask extends Resource
{
    public static $model = \App\CompletedCampusAmbassadorTask::class;

    public static $title = 'id';

    public static $group = 'Ambassador Program';

    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        $ambassadors = User::whereHas('partnerProfile', function (Builder $query) {
            $query->where('partner_type_id', PartnerType::TYPE_CAMPUS_AMBASSADOR_ID);
        })->get()->pluck('name', 'id')->toArray();

        return [
            ID::make()->sortable(),
            BelongsTo::make('Task', 'task', \App\Nova\CampusAmbassadorTask::class)->searchable(),
            Select::make('Ambassador', 'user_id')->options($ambassadors)->required()->onlyOnForms(),
            BelongsTo::make('Ambassador', 'campusAmbassador', \App\Nova\User::class)->searchable()->exceptOnForms(),
            Number::make('Payment Amount', 'amount')->min(1)->readOnly(function () {
                return $this->payment_completed;
            }),
            BelongsTo::make('Payment Record', 'paymentRecord', \App\Nova\Payment::class)->nullable(),
            BelongsTo::make('Payment Method', 'paymentMethod', \App\Nova\PaymentMethod::class)->readOnly(function () {
                return $this->payment_completed;
            })->hideFromIndex(),
            Textarea::make('Ambassador Notes')->alwaysShow(),
            Textarea::make('Admin Notes')->alwaysShow(),
            Boolean::make('Payment Completed')->readOnly(function () {
                return $this->payment_completed;
            }),

            Text::make('Files', function () {
                if (!$this->files) {
                    return '';
                }

                $files = $this->files;

                $snippet = '<ul style="list-style: decimal;" class="p-0 m-0 ml-4">';
                $snippet .= array_reduce($files, function ($total, $file) {
                    return $total . '<li class="my-2"><a class="text-primary" href="' . route('files.download', ['file' => $file['filename'], 'name' => $file['original_name']]) . '">' . $file['original_name'] . '</a></li>';
                });
                $snippet .= '</ul>';

                return $snippet;
            })->asHtml()->onlyOnDetail(),
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
        return [
            (new PayCampusAmbassadorForCompletedTask())
                ->showOnTableRow()
                ->confirmText('Are you sure you want to pay for this task ?')
                ->confirmButtonText('Pay Ambassador')
                ->cancelButtonText('Cancel'),
        ];
    }
}
