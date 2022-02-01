<?php

namespace App\Console\Commands\Reports;

use App\LeveredgeRewardClaim;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PullLeveredgeRewardClaimFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:leveredge-reward-claim-files';

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
     * @return void
     */
    public function handle()
    {
        $claimRewards = LeveredgeRewardClaim::all();
        $progressBar = $this->output->createProgressBar($claimRewards->count());
        $claimRewards->each(function ($rewardClaim) use ($progressBar) {
            if ($rewardClaim->file) {
                $contents = Storage::get($rewardClaim->file->path);
                $pathInfo = explode('.', $rewardClaim->file->path);
                $extension = end($pathInfo);

                Storage::disk('local')->put('/reward_claims/' . $rewardClaim->id . '.' . $extension, $contents);
            }
            $progressBar->advance();
        });

        $progressBar->finish();
    }
}
