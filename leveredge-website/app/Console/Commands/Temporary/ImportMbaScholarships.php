<?php

namespace App\Console\Commands\Temporary;

use App\Imports\MbaScholarships;
use App\Imports\TrackedLinksImport;
use App\MbaScholarship;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportMbaScholarships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:mba-scholarships';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('mba_scholarships')->truncate();

        (new MbaScholarships())->import(database_path('/seeds/Upwork-Scholarships-December2020-MBA-Scholarships-Compiled.csv'));
    }
}
