<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Encryption\Encrypter;

class GenerateSecretKeyForBold extends Command
{
    use ConfirmableTrait;

    protected $signature = 'bold:generate-key {--show}';

    protected $description = 'Generate new secret key for bold.org';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $key = $this->generateRandomKey();

        if (! $this->setKeyInEnvironmentFile($key)) {
            return;
        }

        $this->laravel['config']['bold.secret_key'] = $key;

        if ($this->hasOption('show')) {
            $this->info($key);
        }
        $this->info('Application key set successfully.');
    }

    protected function generateRandomKey()
    {
        return 'base64:'.base64_encode(
                Encrypter::generateKey($this->laravel['config']['app.cipher'])
            );
    }

    protected function setKeyInEnvironmentFile($key)
    {
        $currentKey = $this->laravel['config']['services.bold.secret_key'];

        if (strlen($currentKey) !== 0 && (! $this->confirmToProceed())) {
            return false;
        }

        $this->writeNewEnvironmentFileWith($key);

        return true;
    }

    protected function writeNewEnvironmentFileWith($key)
    {
        file_put_contents($this->laravel->environmentFilePath(), preg_replace(
            $this->keyReplacementPattern(),
            'BOLD_SECRET_KEY='.$key,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }

    protected function keyReplacementPattern()
    {
        $escaped = preg_quote('='.$this->laravel['config']['services.bold.secret_key'], '/');

        return "/^BOLD_SECRET_KEY{$escaped}/m";
    }
}
