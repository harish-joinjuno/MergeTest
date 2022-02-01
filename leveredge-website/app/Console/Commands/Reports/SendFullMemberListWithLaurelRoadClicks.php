<?php

namespace App\Console\Commands\Reports;

use App\AccessTheDeal;
use App\Mail\LaurelRoadEmails;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendFullMemberListWithLaurelRoadClicks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:laurel-road-full-members {email=laurel-road-clicks@joinjuno.com}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send full members email list with clicks';

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
     * @return void
     */
    public function handle()
    {
        $data           = [];
        $headers        = ['Email', 'leveredgeId'];
        array_push($data,$headers);
        $users          = User::whereHas('profile')->with('accessTheDeals')->get();

        /** @var AccessTheDeal $accessTheDeal */
        foreach ($users as $user) {
            foreach ($user->accessTheDeals as $accessTheDeal) {
                array_push($data,[
                    $user->email,
                    $accessTheDeal->deal_id === 14 ? $accessTheDeal->id : '',
                ]);
            }
        }

        $filePath = 'laurel-road-emails/emails-' . date('Y-m-d') . '.csv';
        Storage::disk('local')->put($filePath, '');
        $storagePath = 'app/' . $filePath;

        $fp = fopen(storage_path($storagePath), 'w');

        foreach ($data as $dataRow) {
            fputcsv($fp, $dataRow);
        }

        Mail::to($this->argument('email'))
            ->send(new LaurelRoadEmails($storagePath));
    }
}
