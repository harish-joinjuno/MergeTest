<?php

use App\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferralProgramUserRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('roles')->insert([
            'name'        => Role::ROLE_NAME_REFERRAL_PROGRAM_USER,
            'description' => 'These users have only joined for the referral program',
            'priority'    => 6,
            'created_at'  => now()->format('Y-m-d h:i:s'),
            'updated_at'  => now()->format('Y-m-d h:i:s'),

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $role = Role::where('name',Role::ROLE_NAME_REFERRAL_PROGRAM_USER)->first();
        if ($role) {
            $role->delete();
        }
    }
}
