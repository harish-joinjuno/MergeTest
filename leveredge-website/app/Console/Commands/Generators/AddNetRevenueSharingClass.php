<?php

namespace App\Console\Commands\Generators;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AddNetRevenueSharingClass extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:net-revenue-sharing {name} {percentage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new net revenue sharing file with given percentage';

    protected $files;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $stubContent = file_get_contents(storage_path('stubs/NetRevenueSharing.stub'));
        $stubContent = Str::replaceFirst('__CLASS_NAME__', $this->argument('name'), $stubContent);
        $stubContent = Str::replaceFirst('__PERCENTAGE__', $this->argument('percentage'), $stubContent);
        $name        = 'Partnerships\Concretes\NetRevenueSharing\\' . $this->argument('name');

        $path = $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';

        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
        $this->files->put($path, $stubContent);
        $this->output->writeln('<info>Partnership Net Revenue Sharing Class created successfully!</info>');
    }
}
