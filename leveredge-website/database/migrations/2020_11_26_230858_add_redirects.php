<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRedirects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $redirects = [
            [
                'from'                  => '/products',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/contact-us',
                'to'                    => '/contact',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => 'law',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/join/in-school',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/graduate-student-loans',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/careers/one',
                'to'                    => '/careers',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/career',
                'to'                    => '/careers',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/join/refi',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/meet-with-chris-or-nikhil',
                'to'                    => 'https://calendly.com/chris-nikhil/15',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => false,
            ],
            [
                'from'                  => '/scholarship-201',
                'to'                    => 'https://scholarships.leveredge.org/march2020',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/complete-guide-to-student-loans-for-business-school',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => false,
            ],
            [
                'from'                  => '/complete-guide-to-student-loans-for-business-school/success',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => false,
            ],
            [
                'from'                  => '/complete-guide-to-student-loans-for-business-school/download',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => false,
            ],
            [
                'from'                  => '/understand-your-student-loan-checklist/download',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => false,
            ],
            [
                'from'                  => '/3-reasons',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/3-reasons-why',
                'to'                    => '/',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/referral-program',
                'to'                    => '/member/referral-program',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/browse-mba-scholarships',
                'to'                    => '/search-mba-scholarships',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/browse-law-scholarships',
                'to'                    => '/search-law-scholarships',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/bypa',
                'to'                    => '/p/bypa',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/partner/bypa',
                'to'                    => '/p/bypa',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/pa-cents',
                'to'                    => '/p/pacents8',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/partner/pa-cents',
                'to'                    => '/p/pacents8',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/bar',
                'to'                    => '/p/begp',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/leveredge-w-scholarship-2020',
                'to'                    => '/scholarship/november-scholarship',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/negotiation-essay-scholarship',
                'to'                    => '/scholarship/negotiation-essay-scholarship',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],
            [
                'from'                  => '/careers',
                'to'                    => 'https://jobs.lever.co/leveredge',
                'method'                => 'get',
                'code'                  => 302,
                'with_query_parameters' => true,
            ],

        ];

        foreach ($redirects as $redirect) {
            \App\Redirect::create($redirect);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
