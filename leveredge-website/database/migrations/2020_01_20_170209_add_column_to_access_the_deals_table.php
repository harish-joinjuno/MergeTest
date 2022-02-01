<?php

use App\Deal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColumnToAccessTheDealsTable extends Migration
{
    private $dealsMap = [
        'sent to laurel road'  => Deal::SENT_TO_LAUREL_ROAD,
        'sent to earnest'      => Deal::SENT_TO_EARNEST,
        'sent to not eligible' => Deal::SENT_TO_NOT_ELIGIBLE,
        'sent to credible'     => Deal::SENT_TO_CREDIBLE,
    ];

    public function up()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->unsignedInteger('deal_id')->nullable()->after('id');

            $table->foreign('deal_id')->references('id')->on('deals')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        foreach ($this->dealsMap as $key => $id) {
            DB::table('access_the_deals')->whereResult($key)->update(['deal_id' => $id]);
        }

        DB::table('access_the_deals')->whereResult('needs access code')->delete();
    }

    public function down()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->string('result')->after('id');
        });

        foreach (array_flip($this->dealsMap) as $key => $id) {
            DB::table('access_the_deals')->whereDealId($id)->update(['result' => $key]);
        }

        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->dropForeign('access_the_deals_deal_id_foreign');
            $table->dropColumn('deal_id');
        });
    }
}
