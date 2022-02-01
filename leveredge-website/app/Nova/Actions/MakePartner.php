<?php

namespace App\Nova\Actions;

use App\ContractType;
use App\PartnerType;
use App\Role;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class MakePartner extends Action
{
    use InteractsWithQueue;
    use Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        try {
            foreach ($models as $user) {
                /* @var User $user */
                $user->roles()->attach(Role::ROLE_PARTNER);

                $user->partnerProfile()->updateOrCreate([
                    'contract_type_id' => $fields->contract_type,
                    'partner_type_id'  => $fields->partner_type,
                ]);

                $user->referral_code = $fields->referral_code ?? Str::slug($user->name);
                $user->save();
            }
        } catch (\Excepction $e) {
            Action::danger('Erro: ' . $e->getMessage());
        }
    }

    public function fields()
    {
        return [
            Select::make('Contract Type')->options($this->getContractTypes())->required(),
            Select::make('Partner Type')->options($this->getPartnerTypes())->required(),
            Text::make('Referral Code'),
        ];
    }

    protected function getContractTypes()
    {
        return ContractType::all()->pluck('type', 'id')->toArray();
    }

    protected function getPartnerTypes()
    {
        return PartnerType::all()->pluck('type', 'id')->toArray();
    }
}
