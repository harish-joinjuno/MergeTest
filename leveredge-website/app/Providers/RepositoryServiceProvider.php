<?php


namespace App\Providers;

use App\Repositories\AutoRefinanceApplicationRepository;
use App\Repositories\Contracts\AutoRefinanceApplicationRepositoryInterface;
use App\Repositories\Contracts\ContractTypeRepositoryInterface;
use App\Repositories\Contracts\ExperimentClientRepositoryInterface;
use App\Repositories\Contracts\ExperimentTypeRepositoryInterface;
use App\Repositories\Contracts\FaqGroupRepositoryInterface;
use App\Repositories\Contracts\MagicLoginLinkRepositoryInterface;
use App\Repositories\Contracts\PartnerProfileRepositoryInterface;
use App\Repositories\Contracts\PartnerTypeRepositoryInterface;
use App\Repositories\Contracts\ReferralProgramUserRepositoryInterface;
use App\Repositories\Contracts\UserClientRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\ContractTypeRepository;
use App\Repositories\ExperimentClientRepository;
use App\Repositories\ExperimentTypeRepository;
use App\Repositories\FaqGroupRepository;
use App\Repositories\MagicLoginLinkRepository;
use App\Repositories\PartnerProfileRepository;
use App\Repositories\PartnerTypeRepository;
use App\Repositories\ReferralProgramUserRepository;
use App\Repositories\UserClientRepository;
use App\Repositories\UserRepository;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    protected $repoBindings = [
        MagicLoginLinkRepositoryInterface::class           => MagicLoginLinkRepository::class,
        ContractTypeRepositoryInterface::class             => ContractTypeRepository::class,
        PartnerTypeRepositoryInterface::class              => PartnerTypeRepository::class,
        ReferralProgramUserRepositoryInterface::class      => ReferralProgramUserRepository::class,
        UserRepositoryInterface::class                     => UserRepository::class,
        PartnerProfileRepositoryInterface::class           => PartnerProfileRepository::class,
        ExperimentTypeRepositoryInterface::class           => ExperimentTypeRepository::class,
        ExperimentClientRepositoryInterface::class         => ExperimentClientRepository::class,
        UserClientRepositoryInterface::class               => UserClientRepository::class,
        AutoRefinanceApplicationRepositoryInterface::class => AutoRefinanceApplicationRepository::class,
        FaqGroupRepositoryInterface::class                 => FaqGroupRepository::class,
    ];

    public function register()
    {
        foreach ($this->repoBindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    public function provides(): array
    {
        return array_keys($this->repoBindings);
    }
}
