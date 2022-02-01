<?php

namespace App\Console\Commands\BatchProcesses;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class ClearUnusedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:unused-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear uploaded files that were not used';

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
     * @return mixed
     */
    public function handle()
    {
        try {
            $files = File::allFiles(storage_path('app/public/negotiation-groups'));
            foreach ($files as $file) {
                $filePath = Str::replaceFirst(storage_path('app/'),'', $file->getRealPath());
                if (! \App\File::wherePath($filePath)->exists()) {
                    File::delete($file->getRealPath());
                }
            }
        } catch (DirectoryNotFoundException $exception) {
            // No problem, we don't have any files to delete today
        }
    }
}
