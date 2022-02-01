<?php


namespace App\Console\Commands\Temporary;

use App\DisclosureDetail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SetupHistoricalDisclosureDetails extends Command
{
    protected $signature = 'setup-historical-disclosure-details';

    protected $description = 'Generate new secret key for bold.org';

    public function handle()
    {
        DisclosureDetail::whereJsonContains('response->error','s3_url expired, please input the latest url ...')
            ->orWhereNull('response')
            ->each(function (DisclosureDetail $disclosureDetail) {
                $s3Url = Storage::temporaryUrl($disclosureDetail->leveredgeRewardClaim->file->path, now()->addDay());
                $disclosureDetail->s3_url = $s3Url;
                $disclosureDetail->response_received = 0;
                $disclosureDetail->save();
            });
    }
}
