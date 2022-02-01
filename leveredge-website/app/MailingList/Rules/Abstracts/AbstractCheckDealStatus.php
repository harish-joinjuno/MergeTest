<?php


namespace App\MailingList\Rules\Abstracts;

use App\AccessTheDeal;
use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\MailingList\Rules\Exceptions\StaticPropertyNotDefinedException;
use App\User;

/**
 * @property $dealId
 * @property $loanStatusesIds
 */
abstract class AbstractCheckDealStatus implements MailingListRuleInterface
{
    public function passes(User $user)
    {
        return AccessTheDeal::where('user_id',$user->id)
            ->where('deal_id',$this->dealId)
            ->whereIn('loan_status_id', $this->loanStatusesIds)
            ->exists();
    }

    public function __get($key)
    {
        if (! isset(static::$dealId)) {
            throw (new StaticPropertyNotDefinedException())->setMessage(get_called_class(), 'dealId');
        }

        if (! isset(static::$loanStatusesIds)) {
            throw (new StaticPropertyNotDefinedException())->setMessage(get_called_class(), 'loanStatusesIds');
        }

        return static::$$key;
    }
}
