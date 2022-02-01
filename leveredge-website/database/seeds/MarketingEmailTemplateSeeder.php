<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketingEmailTemplateSeeder extends Seeder
{

    public function run()
    {
        $templates = [
            [
                'name'    => 'Edvisors Email 1',
                'slug'    => 'edvisors-email-1',
                'subject' => 'Looking for a loan? Don’t go it alone'
            ],
            [
                'name'    => 'Edvisors Email 2',
                'slug'    => 'edvisors-email-2',
                'subject' => '2 Things to Know About Lowering Your Student Loan Debt, {{first_name}}'
            ],
            [
                'name'    => 'Edvisors Email 3',
                'slug'    => 'edvisors-email-3',
                'subject' => '{{first_name}}, don’t let student loan debt wreck your plans...'
            ],
            [
                'name'    => 'Edvisors Email 4',
                'slug'    => 'edvisors-email-4',
                'subject' => '{{first_name}}, you have two choices'
            ],
            [
                'name'    => 'Edvisors Email 5',
                'slug'    => 'edvisors-email-5',
                'subject' => '{{first_name}}, are you overpaying for your education?'
            ],
            [
                'name'    => 'Edvisors Email 6',
                'slug'    => 'edvisors-email-6',
                'subject' => 'The #1 Way to Spend Less on Your Education'
            ]
        ];

        foreach ($templates as $template) {
            DB::table('marketing_email_templates')->insert($template);
        }
    }
}
