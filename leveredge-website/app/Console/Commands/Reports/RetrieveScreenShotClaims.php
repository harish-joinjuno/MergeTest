<?php

namespace App\Console\Commands\Reports;

use App\InternationalStudentHealthInsuranceClaim;
use App\LeveredgeRewardClaim;
use App\ScreenshotClaim;
use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class RetrieveScreenShotClaims extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'juno:retrieve-s3-files';

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
     * @return int
     */
    public function handle()
    {
        $claimType = $this->choice('Choose a file type to download', ['ScreenshotClaim', 'LeveredgeRewardClaim', 'InternationalStudentHealthInsuranceClaim'], 0);
        switch ($claimType)
        {
            case 'ScreenshotClaim':
                $this->info('Downloading ScreenshotClaims');
                $screenshots = ScreenshotClaim::all();
                break;
            case 'LeveredgeRewardClaim':
                $this->info('Downloading LeveredgeRewardClaims');
                $screenshots = LeveredgeRewardClaim::all();
                break;
            case 'InternationalStudentHealthInsuranceClaim':
                $this->info('Downloading InternationalStudentHealthInsuranceClaims');
                $screenshots = InternationalStudentHealthInsuranceClaim::all();
                break;
        }

        $this->info('Copying files to.: '.storage_path('app'));
        $count      = $screenshots->count();
        $bar        = $this->output->createProgressBar($count);
        $bar->start();
        foreach ($screenshots as $screenshot) {
            if(Storage::disk('s3')->exists($screenshot->file->path))
            {
                $this->info(' - Copying S3 file.: '.$screenshot->file->path);
                $file = Storage::disk('s3')->get($screenshot->file->path);
                Storage::disk('local')->put($screenshot->id.'-'.$screenshot->file->original_name, $file);
            } else {
                $this->info('File Not found.: '.$screenshot->file->path);
            }
            $bar->advance();
        }
        $bar->finish();
        $this->info('Copied files to.: '.storage_path('app'));
        return 0;
    }
}
