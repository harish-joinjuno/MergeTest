<?php

namespace App\Jobs;

use App\LeveredgeRewardClaim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CreateDisclosureDetailForLeveredgeRewardClaim implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leveredgeRewardClaim;

    /**
     * Create a new job instance.
     *
     * @param LeveredgeRewardClaim $leveredgeRewardClaim
     */
    public function __construct(LeveredgeRewardClaim $leveredgeRewardClaim)
    {
        $this->leveredgeRewardClaim = $leveredgeRewardClaim;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->leveredgeRewardClaim->file) {
            $s3Url = Storage::temporaryUrl($this->leveredgeRewardClaim->file->path, now()->addMinutes(5));
            $this->leveredgeRewardClaim->disclosureDetail()->create([
                's3_url' => $s3Url,
            ]);
        }
    }
}
