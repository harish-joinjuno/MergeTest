<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyticsSourceRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $isTesting = (app()->runningInConsole() || app()->runningUnitTests());

        Schema::create('analytics_source_rules', function (Blueprint $table) {
            $table->id();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();
            $table->boolean('referred_by_id_exists')->nullable();
            $table->foreignId('heard_from_option_id')->nullable()->constrained();
            $table->boolean('gclid_exists')->nullable();
            $table->foreignId('analytics_source_id')->constrained();
            $table->integer('sort_order');
            $table->timestamps();
        });

        \App\AnalyticsSourceRule::insert([
            'utm_source'            => 'google',
            'analytics_source_id'   => 1,
            'sort_order'            => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'heard_from_option_id'     => $isTesting ? null : 6,
            'analytics_source_id'      => 1,
            'sort_order'               => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'heard_from_option_id'     => $isTesting ? null : 7,
            'analytics_source_id'      => 2,
            'sort_order'               => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'            => 'facebook',
            'analytics_source_id'   => 2,
            'sort_order'            => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'twitter',
            'analytics_source_id'     => 3,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'heard_from_option_id'     => $isTesting ? null : 8,
            'analytics_source_id'      => 3,
            'sort_order'               => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'MBA Battle Royale Attendees 2020',
            'analytics_source_id'     => 3,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'GMASS',
            'analytics_source_id'     => 3,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'Linkedin',
            'analytics_source_id'     => 3,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'Clearadmit',
            'analytics_source_id'     => 3,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'instagram' ,
            'analytics_source_id'     => 4,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
                'utm_source'            => 'bold' ,
                'analytics_source_id'   => 5,
                'sort_order'            => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
                'utm_source'              => 'email',
                'utm_medium'              => 'p_partner',
                'analytics_source_id'     => 5,
                'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
                'utm_source'              => 'up_partner',
                'analytics_source_id'     => 5,
                'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
                'heard_from_option_id'     => $isTesting ? null : 2,
                'analytics_source_id'      => 5,
                'sort_order'               => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
                'heard_from_option_id'     => $isTesting ? null : 3,
                'analytics_source_id'      => 5,
                'sort_order'               => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
                'heard_from_option_id'     => $isTesting ? null : 4,
                'analytics_source_id'      => 5,
                'sort_order'               => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
                'heard_from_option_id'     => $isTesting ? null : 5,
                'analytics_source_id'      => 5,
                'sort_order'               => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
                'heard_from_option_id'     => $isTesting ? null : 9,
                'analytics_source_id'      => 6,
                'sort_order'               => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
                'heard_from_option_id'     => $isTesting ? null : 10,
                'analytics_source_id'      => 7,
                'sort_order'               => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'referred_by_id_exists' => true,
            'analytics_source_id'   => 7,
            'sort_order'            => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'            => 'Kickoff Labs $1K Scholarship',
            'analytics_source_id'   => 7,
            'sort_order'            => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'            => 'referral',
            'analytics_source_id'   => 7,
            'sort_order'            => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'Financial Aid Offices',
            'analytics_source_id'     => 7,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'petersons',
            'analytics_source_id'     => 7,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'ScholarshipApp v1',
            'analytics_source_id'     => 7,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'LeverEdge Customers',
            'analytics_source_id'     => 7,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'utm_source'              => 'email',
            'utm_medium'              => 'up_partner',
            'analytics_source_id'     => 7,
            'sort_order'              => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'heard_from_option_id'     => $isTesting ? null : 1,
            'analytics_source_id'      => 8,
            'sort_order'               => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
        \App\AnalyticsSourceRule::insert([
            'analytics_source_id'   => 8,
            'sort_order'            => \Illuminate\Support\Facades\DB::table('analytics_source_rules')->count() + 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analytics_source_rules');
    }
}
