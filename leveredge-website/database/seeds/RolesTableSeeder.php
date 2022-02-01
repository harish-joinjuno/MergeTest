<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $role              = new Role();
        $role->name        = 'borrower';
        $role->description = 'Potential Borrower';
        $role->save();

        $role              = new Role();
        $role->name        = 'lender';
        $role->description = 'Potential Partner Lender';
        $role->save();

        $role              = new Role();
        $role->name        = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role              = new Role();
        $role->name        = 'partner';
        $role->description = 'Marketing Partner';
        $role->save();

        $role              = new Role();
        $role->name        = 'nova-user';
        $role->description = 'Nova User (Not Admin)';
        $role->save();

        DB::statement("UPDATE roles SET priority = 1 WHERE name = 'admin'");
        DB::statement("UPDATE roles SET priority = 2 WHERE name = 'partner'");
        DB::statement("UPDATE roles SET priority = 3 WHERE name = 'lender'");
        DB::statement("UPDATE roles SET priority = 4 WHERE name = 'borrower'");
        DB::statement("UPDATE roles SET priority = 5 WHERE name = 'nova-user'");
    }
}
