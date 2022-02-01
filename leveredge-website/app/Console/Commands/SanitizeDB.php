<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SanitizeDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'juno:sanitize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sanitize copy of production database to use on staging environment';

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
     * @return int
     */
    public function handle()
    {
        if (App::environment('production') ||
            strtolower(env('DB_HOST')) == 'app.leveredge.org' ||
            strtolower(env('DB_HOST')) == '50.19.113.20') {
            $this->info('You can not run this command in production!');
            return true;
        }

        if (App::environment('local') ||
            App::environment('staging')) {
            $this->truncate('affiliates', false);
            $this->truncate('bold_students', false);
            $this->truncate('inschool_subscribers', false);
            $this->truncate('law_school_bar_tab_competition_entrants', false);
            $this->truncate('leads', false);
            $this->truncate('marketing_email_unsubscribes', false);
            $this->truncate('marketing_emails', false);
            $this->truncate('refinance_subscribers', false);
            $this->truncate('refinance_test_users', false);
            $this->truncate('wait_list_members', false);
            DB::table('sms_messages')->update(['from' => '+10123456789']);
            DB::table('sms_messages')->update(['to' => '+10123456789']);
            $this->replaceUserEmails();
            $this->info(PHP_EOL . 'Done!');
        } else {
            $this->info('DB Sanitize did not run!');
        }

    }

    private function replaceUserEmails()
    {
        DB::select(
    'UPDATE users AS u1 INNER JOIN (SELECT id, COALESCE (first_name, \'John\') AS first_name FROM users) AS u2
                SET
                    u1.email = concat(u2.first_name, u2.id,\'@leveredge.test\'),
                    u1.last_name = \'Smith\',
                    u1.name = concat(u2.first_name, \' Smith\')
                where u1.id = u2.id');
    }

    private function truncate($table, $disable_output = true)
    {
        if ($disable_output) {
            DB::table($table)->truncate();
            return true;
        }
        $count = DB::table($table)->count();
        $this->info(PHP_EOL . 'Truncating.: ' . $table . ': ' . $count);
        $bar = $this->output->createProgressBar($count);
        $bar->start();
        DB::table($table)->truncate();
        $bar->finish();
        $count = DB::table($table)->count();
        $this->info(PHP_EOL . 'Truncated.: ' . $table . ': ' . $count);
        return true;
    }
}
