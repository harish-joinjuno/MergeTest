<?php

namespace App\Console\Commands;

use App\NegotiationGroupUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Pull2122DomesticGroupUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:ng-21-22';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        NegotiationGroupUser::whereIn('negotiation_group_id', [8, 9, 10])
            ->whereNotIn('negotiation_group_id', [22])
            ->whereHas('user', function ($query) {
                return $query->whereHas('profile', function ($query) {
                    return $query->where('graduation_year', '>=', 2022)
                        ->orWhere('grad_graduation_year', '>=', 2022);
                });
            })
            ->get()
            ->each
            ->addToNegotiationGroup22;
    }
}
