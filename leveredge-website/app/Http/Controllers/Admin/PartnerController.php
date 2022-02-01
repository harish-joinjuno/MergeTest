<?php


namespace App\Http\Controllers\Admin;

use App\ContractType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContractTypeRequest;
use App\Http\Requests\Admin\PartnerRequest;
use App\Http\Requests\Admin\PartnerTypeRequest;
use App\PartnerType;
use App\ReferralProgram;
use App\ReferralProgramUser;
use App\Repositories\Contracts\ContractTypeRepositoryInterface;
use App\Repositories\Contracts\PartnerTypeRepositoryInterface;
use App\Repositories\Contracts\ReferralProgramUserRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Role;
use App\User;

class PartnerController extends Controller
{
    protected $partnerTypeRepo;

    protected $contractTypeRepo;

    public function __construct(
        PartnerTypeRepositoryInterface $partnerTypeRepo,
        ContractTypeRepositoryInterface $contractTypeRepo
    ) {
        $this->partnerTypeRepo  = $partnerTypeRepo;
        $this->contractTypeRepo = $contractTypeRepo;
    }

    public function show()
    {
        return view('admin.partners.create', [
            'partnerTypes'  => $this->partnerTypeRepo->all(),
            'contractTypes' => $this->contractTypeRepo->all(),
        ]);
    }

    public function store(
        PartnerRequest $request,
        UserRepositoryInterface $userRepo,
        ReferralProgramUserRepositoryInterface $referralProgramUserRepo)
    {
        $user = $userRepo->createAsPartnerWithPartnerProfile($request->all());

        if ($user->partnerProfile->isCampusAmbassador()) {
            $referralProgramUserRepo->createQuarterPercentOfFirstLoan($user->id);
        }

        $user->refresh();

        return redirect()->back()->with([
            'message' => 'New user: [' . $user->name . '] created successfully as partner !',
        ]);
    }

    public function partnerTypeStore(PartnerTypeRequest $request)
    {
        $this->partnerTypeRepo->store($request->only('type'));

        return redirect()->back();
    }

    public function contractTypeStore(ContractTypeRequest $request)
    {
        $this->contractTypeRepo->store($request->only('type'));

        return redirect()->back();
    }
}
