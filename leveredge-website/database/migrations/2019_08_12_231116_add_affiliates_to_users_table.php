<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddAffiliatesToUsersTable extends Migration
{
    public function up()
    {
        // Delete the Immigration Status Column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('immigration_status');
        });

        // We Add the Affiliates to LeverEdge
        $affiliates = DB::table('affiliates')->get();
        foreach ($affiliates as $affiliate) {
            if (isset($affiliate->name) && isset($affiliate->email)) {
                if (!User::where('email', $affiliate->email)->exists()) {
                    $user           = new User();
                    $user->name     = $affiliate->name;
                    $user->email    = $affiliate->email;
                    $user->password = Hash::make(Str::random(8));
                    $user->save();

                    $user->roles()->attach(1);
                }
            }
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('immigration_status')->default('Not Applicable');
        });
    }
}
