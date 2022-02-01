<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewDataToMarketingEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketing_email_templates', function (Blueprint $table) {
            $data = [
                [
                    'slug'    => '15-alumni-1st-introduction',
                    'name'    => '15 Alumni 1st Email',
                    'subject' => 'How Harvard Students Are Fighting The Student Debt Crisis'
                ],
                [
                    'slug'    => '16-alumni-2nd-who-we-help',
                    'name'    => '16 Alumni 2nd Who We Help',
                    'subject' => 'Find Out If You’re Eligible To Join Us Today'
                ],
                [
                    'slug'    => '17-alumni-3rd-deadline',
                    'name'    => '17 Alumni 3rd Deadline',
                    'subject' => 'Don’t miss your chance on this round'
                ],
                [
                    'slug'    => '18-dentists-1st-introduction',
                    'name'    => '18 Dentists 1st Introduction',
                    'subject' => 'How Harvard Students Are Fighting The Student Debt Crisis'
                ],
                [
                    'slug'    => '19-dentists-2nd-who-we-help',
                    'name'    => '19 Dentists 2nd Who We Help',
                    'subject' => 'Help your team for free today'
                ],
                [
                    'slug'    => '20-dentists-3rd-deadline',
                    'name'    => '20 Dentists 3rd Deadline',
                    'subject' => 'Don’t miss your chance on this round'
                ]
            ];
            foreach($data as $marketingEmailTemplate) {
                \App\MarketingEmailTemplate::firstOrCreate($marketingEmailTemplate, $marketingEmailTemplate);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketing_email_templates', function (Blueprint $table) {
            //
        });
    }
}
