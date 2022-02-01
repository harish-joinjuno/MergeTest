<?php

use App\ContractType;
use App\PartnerProfile;
use App\PartnerType;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user                = new User();
        $user->email         = 'nikhil@leveredge.org';
        $user->name          = 'Nikhil Agarwal';
        $user->password      = bcrypt('secret');
        $user->referral_code = Str::random(8);
        $user->save();
        $user->roles()->attach(Role::ROLE_ADMIN);
        $user->profile()->create();

        $user                = new User();
        $user->email         = 'team@devsquad.com';
        $user->name          = 'DevSquad Team';
        $user->password      = bcrypt('secret');
        $user->referral_code = Str::random(8);
        $user->save();
        $user->roles()->attach(Role::ROLE_ADMIN);
        $user->profile()->create();

        $user                = new User();
        $user->email         = 'borrower@email.com';
        $user->name          = 'Peter Borrower';
        $user->password      = bcrypt('secret');
        $user->referral_code = Str::random(8);
        $user->save();
        $user->roles()->attach(Role::ROLE_BORROWER);
        $user->profile()->create();

        $user                = new User();
        $user->email         = 'referred-borrower@email.com';
        $user->name          = 'Marga Referred Borrower';
        $user->password      = bcrypt('secret');
        $user->referral_code = Str::random(8);
        $user->save();
        $user->roles()->attach(Role::ROLE_BORROWER);
        $user->profile()->create();

        $user                = new User();
        $user->email         = 'lender@email.com';
        $user->name          = 'Mary Lender';
        $user->password      = bcrypt('secret');
        $user->referral_code = Str::random(8);
        $user->save();
        $user->roles()->attach(Role::ROLE_LENDER);
        $user->profile()->create();

        $user                = new User();
        $user->email         = 'partner@email.com';
        $user->name          = 'Austin Partner';
        $user->password      = bcrypt('secret');
        $user->referral_code = Str::random(8);
        $user->save();
        $user->roles()->attach(Role::ROLE_PARTNER);
        $user->profile()->create();

        $user                = new User();
        $user->email         = 'ambassador@email.com';
        $user->name          = 'Elizabeth Ambassador';
        $user->password      = bcrypt('secret');
        $user->referral_code = Str::random(8);
        $user->save();
        $user->roles()->attach(Role::ROLE_PARTNER);

        /** @var ContractType $contractType */
        $contractType = ContractType::query()->firstOrFail();

        /** @var PartnerType $partnerType */
        $partnerType = PartnerType::query()->firstOrFail();

        $partnerProfile                   = new PartnerProfile();
        $partnerProfile->user_id          = $user->id;
        $partnerProfile->contract_type_id = $contractType->id;
        $partnerProfile->partner_type_id  = $partnerType->id;
        $partnerProfile->save();
    }
}
