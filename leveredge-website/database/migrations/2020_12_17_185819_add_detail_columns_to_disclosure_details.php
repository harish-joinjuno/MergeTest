<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailColumnsToDisclosureDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disclosure_details', function (Blueprint $table) {
            $table->boolean('response_expanded')->default(false)->after('response_received');
            $table->boolean('response_has_error')->nullable()->after('response_expanded');
            $table->text('document')->nullable()->after('response_has_error');
            $table->string('creditor')->nullable()->after('document');
            $table->string('borrower_name')->nullable()->after('creditor');
            $table->string('cosigner_name')->nullable()->after('borrower_name');
            $table->decimal('interest_rate')->nullable()->after('cosigner_name');
            $table->string('rate_type')->nullable()->after('interest_rate');
            $table->integer('loan_term')->nullable()->after('rate_type');
            $table->decimal('apr')->nullable()->after('loan_term');
            $table->decimal('finance_charge')->nullable()->after('apr');
            $table->decimal('total_payments')->nullable()->after('finance_charge');
            $table->decimal('total_loan_amount')->nullable()->after('total_payments');
            $table->boolean('right_to_cancel')->nullable()->after('total_loan_amount');
            $table->date('right_to_cancel_date')->nullable()->after('right_to_cancel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('disclosure_details', function (Blueprint $table) {
            $table->dropColumn('response_expanded');
            $table->dropColumn('response_has_error');
            $table->dropColumn('document');
            $table->dropColumn('creditor');
            $table->dropColumn('borrower_name');
            $table->dropColumn('cosigner_name');
            $table->dropColumn('interest_rate');
            $table->dropColumn('rate_type');
            $table->dropColumn('loan_term');
            $table->dropColumn('apr');
            $table->dropColumn('finance_charge');
            $table->dropColumn('total_payments');
            $table->dropColumn('total_loan_amount');
            $table->dropColumn('right_to_cancel');
            $table->dropColumn('right_to_cancel_date');
        });
    }
}
