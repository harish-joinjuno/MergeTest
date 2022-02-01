<?php

namespace App\Console\Commands\ManageCrawlers;

use App\InternalIpAddress;
use App\Mail\BotCommandEmailNotifier;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class IdentifyBots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'juno:identify-bots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Identifies Bots and adds them to the internal ip addresses table';

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
        // We can skip anything already classified as a crawler
        $requests = DB::select(
            "SELECT from_unixtime(unix_timestamp(cr.created_at) - unix_timestamp(cr.created_at)%300) groupTime, cr.ip, count(*) as requests, count(distinct cr.user_agent) as unique_user_agents, count(distinct client_id) as unique_clients
                    FROM client_requests cr
                    left join internal_ip_addresses iia on cr.ip = iia.ip
                    where iia.ip is null and crawler = 0
                    GROUP BY groupTime, cr.ip
                    having unique_user_agents > 2"
        );

        $iiasToSend = [];
        foreach ($requests as $request) {
            $iia       = InternalIpAddress::firstOrNew(['ip' => $request->ip]);
            $iia->name = 'Potential Bot';
            $iia->save();
            $iiasToSend[] = $iia;
        }
        if (count($requests)) {
            Log::channel('slack_potential_bot')->notice(count($requests) . ' potential bots added');
            Mail::to('max@joinjuno.com')->send(new BotCommandEmailNotifier($iiasToSend));
        }
    }
}
