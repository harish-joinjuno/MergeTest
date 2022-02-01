<?php

namespace App\Jobs;


use Illuminate\Support\Facades\Storage;

class ClearHashedEmails
{

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Storage::disk('local')->delete('hashed-emails/emails-' . date('Y-m-d') . '.csv');
    }
}
