<?php

namespace App\Console\Commands\Reports;

use App\Mail\HashedEmails;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendHashedEmails extends Command
{
    protected $signature = 'send:hashed-emails {email=hashed_emails@leveredge.org}';

    protected $description = 'Send hashed emails';

    public function handle()
    {
        $users = User::all()
            ->pluck('email')
            ->filter(function ($email) {
                return $email !== 'does.not.exist@leveredge.org';
            })
            ->toArray();
        array_push($users, 'exists@leveredge.org');

        $filePath = 'hashed-emails/emails-' . date('Y-m-d') . '.csv';
        Storage::disk('local')->put($filePath, '');
        $storagePath = 'app/' . $filePath;

        $fp = fopen(storage_path($storagePath), 'w');

        foreach ($users as $user) {
            fputcsv($fp, [bcrypt($user)]);
        }

        Mail::to($this->argument('email'))
            ->send(new HashedEmails($storagePath));
    }
}
