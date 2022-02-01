<?php


namespace App\Services;

use App\Experiment;
use App\Repositories\Contracts\ExperimentClientRepositoryInterface;
use App\Repositories\Contracts\ExperimentTypeRepositoryInterface;
use App\Repositories\Contracts\UserClientRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class Experiments
 * @package App\Services
 *
 * @method self setTempleRedirectUrls()
 * @method self setAutoRefiRedirectUrls()
 * @method self setRefinanceRedirectUrls()
 */
class Experiments
{
    private $experimentTypeRepo;

    private $experimentClientRepo;

    private $experimentClient;

    private $client;

    private $autoRefiExperimentRouteMaps = [
        Experiment::AUTO_REFINANCE_LANDING_PAGE_V2 => '/loans/auto-refinance/v2',
        Experiment::AUTO_REFINANCE_LANDING_PAGE_V3 => '/loans/auto-refinance/v3',
        Experiment::AUTO_REFINANCE_LANDING_PAGE_V4 => '/loans/auto-refinance/v4',
        Experiment::AUTO_REFINANCE_LANDING_PAGE_V5 => '/loans/auto-refinance/v5',
        Experiment::AUTO_REFINANCE_LANDING_PAGE_V6 => '/loans/auto-refinance/v6',
        Experiment::AUTO_REFINANCE_LANDING_PAGE_V7 => '/loans/auto-refinance/v7',
        Experiment::AUTO_REFINANCE_LANDING_PAGE_V8 => '/loans/auto-refinance/v8',
        Experiment::AUTO_REFINANCE_LANDING_PAGE_V9 => '/loans/auto-refinance/v9',
    ];

    private $templeExperimentRouteMaps = [
        Experiment::TEMPLE_V2 => '/loans/undergraduate/temple/v2',
    ];

    private $refinanceExperimentRouteMaps = [
        Experiment::LONG_FORM_LANDING_PAGE                         => '/loans/refinance/v2',
        Experiment::LONG_FORM_LANDING_PAGE_WITH_VIDEO_IN_BODY      => '/loans/refinance/v4',
        Experiment::LONG_FORM_WITH_EMAIL_CAPTURE_AND_VIDEO_IN_BODY => '/loans/refinance/v5',
        Experiment::SLR_LONG_FORM_VIDEO_IN_BODY_AUTO_PLAY          => '/loans/refinance/v6',
        Experiment::SLR_LONG_FORM_VIDEO_2_IN_BODY_AUTO_PLAY        => '/loans/refinance/v7',
        Experiment::SLR_V8                                         => '/loans/refinance/v8',
    ];

    private $activeExperimentRedirectUrls = [];

    public function __construct(
        ExperimentTypeRepositoryInterface $experimentTypeRepo,
        ExperimentClientRepositoryInterface $experimentClientRepo)
    {
        $this->experimentTypeRepo   = $experimentTypeRepo;
        $this->experimentClientRepo = $experimentClientRepo;
        $this->client               = getClient();
    }

    public function getOrAssignExperimentOfType($experimentTypeId): Experiments
    {
        $this->getOrAssignExperiment($experimentTypeId);

        return $this;
    }

    public function getOrAssignExperimentOfTypes(array $experimentTypeIds): Experiments
    {
        foreach ($experimentTypeIds as $experimentTypeId) {
            $this->getOrAssignExperiment($experimentTypeId);
        }

        return $this;
    }

    public function isPartOfExperiment($experimentId)
    {
        $query = $this->experimentClientRepo->query()
            ->where('experiment_id', $experimentId);

        if ($this->client->userClient) {
            $relatedClientIds = resolve(UserClientRepositoryInterface::class)
                ->forUser($this->client->userClient->user_id)
                ->pluck('client_id');

            return $query->whereIn('client_id',$relatedClientIds)->exists();
        }

        return $query->where('client_id',$this->client->id)->exists();
    }

    public function getRedirectUrl()
    {
        $redirectUrl = null;
        foreach ($this->activeExperimentRedirectUrls as $experimentId => $route) {
            if (!$redirectUrl && $this->isPartOfExperiment($experimentId)) {
                $redirectUrl = $route;

                break;
            }
        }

        return $redirectUrl;
    }

    public function getExperiment()
    {
        return optional($this->experimentClient)->experiment;
    }

    private function getOrAssignExperiment($experimentTypeId)
    {
        try {
            $this->experimentClientRepo
                ->forClientWhereHasExperimentForType($experimentTypeId);
        } catch (ModelNotFoundException $exception) {
            $experimentsRotation = $this->experimentTypeRepo->pluckWithActiveExperiments($experimentTypeId);

            $lastExperimentIdInArray = $this->experimentClientRepo->lastExperimentFromExperiments($experimentsRotation);

            $experimentIndex = 0;

            if (count($lastExperimentIdInArray)) {
                $lastExperimentId = $lastExperimentIdInArray[0];
                $indexRotation    = array_search($lastExperimentId, $experimentsRotation);
                $experimentIndex  = $indexRotation +1;

                if ($experimentIndex > count($experimentsRotation) - 1) {
                    $experimentIndex = 0;
                }
            }
            if (isset($experimentsRotation[$experimentIndex])) {
                $this->experimentClientRepo->assignToExperimentAsClient($experimentsRotation[$experimentIndex]);
            }
        }
    }

    public function __call($method, $args): self
    {
        preg_match('/set(.*)RedirectUrls/',$method,$matches);

        if ($matches && count($matches) === 2) {
            $activeExperimentUrls               = lcfirst($matches[1]) . 'ExperimentRouteMaps';
            $this->activeExperimentRedirectUrls = $this->$activeExperimentUrls;
        }

        return $this;
    }
}
