<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Encryption\DecryptException;

class FixPartnerPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:partner-password';

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
        $userIds = [
            41836,
            41932,
            42099,
            42500,
            42522,
            42701,
            42712,
            42986,
            43722,
            43942,
            44148,
            44379,
            44884,
            45042,
            45043,
            45044,
            45067,
            45511,
            46152,
            46467,
            46645,
            47394,
            47433,
            47445,
            47538,
            47580,
            47725,
            48269,
        ];

        $users = User::whereIn('id', $userIds)->get();

        $users->each(function (User $user) {
            $this->output->comment($user->email . ' - ' . $user->password);
            $user->password = bcrypt($user->password);
            $user->save();
        });
    }
}
