<?php

namespace App\Nova;

use App\Nova\Actions\PageSectionHide;
use App\Nova\Actions\PageSectionPublish;
use App\PageSection as PageSectionModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;

class PageSection extends Resource
{
    public static $model = PageSectionModel::class;

    public static $group = 'Admin';

    public static $search = [
        'id',
        'section_name',
        'target_page',
    ];

    public function title()
    {
        return $this->target_page . ' - ' . $this->section_name;
    }

    public function fields(Request $request)
    {
        return [
            ID::make()
                ->sortable(),
            Text::make('Target Page')
                ->readonly()
                ->sortable(),
            Text::make('Section Name')
                ->readonly()
                ->sortable(),
            Text::make('Status', function () {
                /** @var PageSectionModel $pageSection */
                $pageSection = $this;

                $status = ($pageSection->published_at) ? 'Published' : 'Hidden';
                $color  = ($status === 'Published') ? '#9ae6b4' : '#e2e8f0';

                if ($status === 'Published' && $pageSection->working_content != $pageSection->published_content) {
                    $status = 'Republish';
                    $color  = '#faf089';
                }

                return "<span class=\"rounded-full text-black text-sm px-4 py-0\" style=\"background-color: {$color}\">{$status}</span>";
            })
                ->asHtml()
                ->textAlign('center'),
            DateTime::make('Published At')
                ->readonly()
                ->format('MMM, DD YYYY \a\t h:m a')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            Trix::make('Working Content')
                ->hideFromIndex(),
            Trix::make('Published Content')
                ->hideWhenUpdating()
                ->hideWhenCreating(),
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
        $publish = new PageSectionPublish();

        return [
            $publish,
            new PageSectionHide(),
        ];
    }
}
