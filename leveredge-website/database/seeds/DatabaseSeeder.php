<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(DegreesTableSeeder::class);
        $this->call(UniversitiesTableSeeder::class);
        $this->call(ContractTypesTableSeeder::class);
        $this->call(PartnerTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MenuLinksTableSeeder::class);
        $this->call(PageSectionsTableSeeder::class);
        $this->call(CampusAmbassadorTaskSeeder::class);
        $this->call(PaymentMethodTableSeeder::class);
        $this->call(AcademicYearsTableSeeder::class);
        $this->call(NegotiationGroupFaqSeeder::class);
    }
}
