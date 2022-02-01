<?php


namespace App\ActionNotifications\Concretes\DisplayNotificationRules;

use App\ActionNotification;
use App\ActionNotifications\Abstracts\AbstractActionNotificationVisibilityRule;
use App\NegotiationGroupUser;
use App\SimpleActionNotificationRule;
use App\User;

class ActionNotificationsRuleTable extends AbstractActionNotificationVisibilityRule
{
    public static $title = 'Simple Action Notification Rules Table';

    public static $description = 'You can define the rules in Nova / Database in the Simple Action Notification Rules';

    public static function passes(User $user, ActionNotification $actionNotification): bool
    {
        $visibilityRules = SimpleActionNotificationRule::whereActionNotificationId($actionNotification->id)->get();
        foreach ($visibilityRules as $visibilityRule) {
            if (self::matchesProfile($user, $visibilityRule)) {
                return true;
            }
        }

        return false;
    }

    protected static function matchesProfile(User $user, SimpleActionNotificationRule $rule)
    {
        if (is_null($user->profile)) {
            return false;
        }

        $rules = collect([
            'negotiation_group_id' => $rule->negotiation_group_id,
            'academic_year_id'     => $rule->academic_year_id,
            'university_id'        => $rule->university_id,
            'degree_id'            => $rule->degree_id,
            'grad_university_id'   => $rule->grad_university_id,
            'grad_degree_id'       => $rule->grad_degree_id,
            'immigration_status'   => $rule->immigration_status,
            'credit_score_range'   => $rule->credit_score_range,
            'display_on_page'      => $rule->display_on_page,
        ])->filter(function ($item) {
            return ! empty($item);
        });

        $passedRules = collect();

        foreach ($rules as $availableRule => $value) {
            switch ($availableRule) {
                case 'negotiation_group_id':
                    $passedRules->push(
                        NegotiationGroupUser::whereUserId($user->id)
                            ->whereNegotiationGroupId($value)
                            ->exists()
                    );

                    break;

                case 'academic_year_id':
                    $passedRules->push(
                        NegotiationGroupUser::whereUserId($user->id)
                            ->whereAcademicYearId($value)
                            ->exists()
                    );

                    break;

                case 'university_id':
                    $passedRules->push(
                        $user->profile->university_id === $value
                    );

                    break;

                case 'degree_id':
                    $passedRules->push(
                        $user->profile->degree_id === $value
                    );

                    break;

                case 'grad_university_id':
                    $passedRules->push(
                        $user->profile->grad_university_id === $value
                    );

                    break;

                case 'grad_degree_id':
                    $passedRules->push(
                        $user->profile->grad_degree_id === $value
                    );

                    break;

                case 'immigration_status':
                    $passedRules->push(
                        $user->profile->immigration_status === $value
                    );

                    break;

                case 'credit_score_range':
                    $passedRules->push(
                        $user->profile->credit_score === $value
                    );

                    break;

                case 'display_on_page':
                    $passedRules->push(
                        request()->is($value)
                    );

                    break;

                default: break;
            }
        }

        return $rules->count() === $passedRules->filter(function ($item) {
            return $item === true;
        })->count();
    }
}
