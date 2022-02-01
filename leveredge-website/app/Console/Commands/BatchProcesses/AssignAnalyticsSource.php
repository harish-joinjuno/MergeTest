<?php

namespace App\Console\Commands\BatchProcesses;

use App\AnalyticsSourceRule;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class AssignAnalyticsSource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign-analytics-source {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int|void
     */
    public function handle()
    {
        if ($this->option('all')) {
            $users = User::whereHas('profile')->get();
        } else {
            $users = User::whereHas('profile',function(Builder $query) {
                $query->whereNull('analytics_source_id');
            })->get();
        }

        $rules = AnalyticsSourceRule::orderBy('sort_order','asc')->get();
        foreach ($users as $user) {
            /** @var User $user */
            foreach ($rules as $rule) {
                if ($rule->matches($user)) {
                    $user->profile->analytics_source_id      = $rule->analytics_source_id;
                    $user->profile->analytics_source_rule_id = $rule->id;
                    $user->profile->save();

                    break;
                }
            }
        }
    }
}
