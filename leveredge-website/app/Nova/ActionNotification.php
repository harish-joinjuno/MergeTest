<?php

namespace App\Nova;

use App\ActionNotifications\Abstracts\AbstractActionNotificationVisibilityRule;
use App\ActionNotifications\Abstracts\AbstractDismissableRule;
use App\ActionNotifications\Concretes\DisplayNotificationRules\ActionNotificationsRuleTable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Symfony\Component\Finder\Finder;

class ActionNotification extends Resource
{
    use HasSortableRows;

    public static $model = \App\ActionNotification::class;

    public static $title = 'title';

    public static $group = 'Action Notifications';

    public static $search = [
        'id', 'title', 'description', 'cta_text',
    ];

    public function fields(Request $request)
    {
        $namespace           = app()->getNamespace();
        $visibilityResources = [];
        $visibilityDirectory = base_path('app/ActionNotifications/Concretes/DisplayNotificationRules/');
        $visibilityFiles     = (new Finder)->files()->in($visibilityDirectory);
        foreach ($visibilityFiles as $resource) {
            $resource = $namespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($resource->getPathname(), app_path() . DIRECTORY_SEPARATOR)
                );

            if (is_subclass_of($resource, AbstractActionNotificationVisibilityRule::class)) {
                $visibilityResources[] = $resource;
            }
        }

        $visibilityResourceOptions = [];
        foreach ($visibilityResources as $resource) {
            $visibilityResourceOptions[$resource] = $resource::$title;
        }

        $dismissableResources = [];
        $dismissableDirectory = base_path('app/ActionNotifications/Concretes/DismissableNotificationRules/');
        $dismissableFiles     = (new Finder)->files()->in($dismissableDirectory);
        foreach ($dismissableFiles as $resource) {
            $resource = $namespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($resource->getPathname(), app_path() . DIRECTORY_SEPARATOR)
                );

            if (is_subclass_of($resource, AbstractDismissableRule::class)) {
                $dismissableResources[] = $resource;
            }
        }

        $dismissableResourceOptions = [];
        foreach ($dismissableResources as $resource) {
            $dismissableResourceOptions[$resource] = $resource::$title;
        }

        return [
            ID::make()->sortable(),

            Text::make('Title', 'title')->nullable(),

            Trix::make('Description', 'description')->required(),

            Text::make('Cta Text', 'cta_text')->nullable(),

            Text::make('Cta Link', 'cta_link')->nullable(),

            Text::make('Icon', 'icon')->nullable(),

            Select::make('Notification Style', 'notification_style')
                ->options([
                   'danger'  => 'Danger',
                   'warning' => 'Warning',
                   'success' => 'Success',
                   'accent'  => 'Accent',
                   'info'    => 'Info',
                ])->displayUsingLabels()
                ->nullable(),

            Select::make('Visibility Rule', 'visibility_rule')
                ->options($visibilityResourceOptions)
                ->displayUsingLabels()
                ->withMeta(['value' => ActionNotificationsRuleTable::class])
                ->required(),

            Select::make('Dismissable Rule', 'dismissable_rule')
                ->options($dismissableResourceOptions)
                ->displayUsingLabels()
                ->nullable(),
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
}
