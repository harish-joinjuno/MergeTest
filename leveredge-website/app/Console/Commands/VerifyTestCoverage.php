<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VerifyTestCoverage extends Command
{
    protected $signature = 'app:test-coverage';

    protected $description = 'Verifies the test coverage statistics of the product.';

    public function handle()
    {
        $coverageFilePath = base_path('workspace/coverage.xml');

        if (!file_exists($coverageFilePath)) {
            $this->warn('Coverage file not found');
            return;
        }

        $report = json_decode(json_encode(simplexml_load_string(file_get_contents($coverageFilePath))), true);
    }
}
