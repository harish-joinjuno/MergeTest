<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCosignerStatusToNegotiationGroupEligibleProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negotiation_group_eligible_profiles', function (Blueprint $table) {
            $table->string('cosigner_status')->nullable();
            $table->string('cosigner_immigration_status')->nullable();
            $table->boolean('is_undergrad_student')->nullable();
            $table->boolean('is_grad_student')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('negotiation_group_eligible_profiles', function (Blueprint $table) {
            $table->dropColumn('cosigner_status');
            $table->dropColumn('cosigner_immigration_status');
            $table->dropColumn('is_undergrad_student');
            $table->dropColumn('is_grad_student');
        });
    }
}
