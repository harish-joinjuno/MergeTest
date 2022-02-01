<?php

namespace Tests\Feature\app\Http\Controllers\Admin;

use App\ContractType;
use App\PartnerProfile;
use App\PartnerType;
use App\ReferralProgram;
use App\ReferralProgramUser;
use App\Repositories\Contracts\ContractTypeRepositoryInterface;
use App\Repositories\Contracts\PartnerTypeRepositoryInterface;
use App\Repositories\Contracts\ReferralProgramUserRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Tests\Feature\AdminFeatureTest;

class PartnerControllerTest extends AdminFeatureTest
{
    use WithFaker;

    protected $partnerType;

    protected $contractType;

    protected $partnerTypeRepo;

    protected $contractTypeRepo;

    protected $userRepo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->partnerType             = factory(PartnerType::class)->create();
        $this->contractType            = factory(ContractType::class)->create();
        $this->partnerTypeRepo         = $this->expectsRepository(PartnerTypeRepositoryInterface::class);
        $this->contractTypeRepo        = $this->expectsRepository(ContractTypeRepositoryInterface::class);
        $this->userRepo                = $this->expectsRepository(UserRepositoryInterface::class);
    }

    /**
     * @test
     */
    public function it_should_render_partner_create_page()
    {
        $this->partnerTypeRepo->shouldReceive('all')
            ->once()
            ->andReturn(PartnerType::all());

        $this->contractTypeRepo->shouldReceive('all')
            ->once()
            ->andReturn(ContractType::all());

        $this->actingAs($this->admin)
            ->get(route('admin.partner.create'))
            ->assertStatus(200)
            ->assertViewIs('admin.partners.create')
            ->assertViewHas('partnerTypes', PartnerType::all())
            ->assertViewHas('contractTypes', ContractType::all());
    }

    /**
     * @test
     */
    public function it_should_create_new_partner_profile_for_campus_ambassador_and_creating_new_referral_program_user()
    {
        $data = [
            'name'          => $this->faker->firstName,
            'email'         => $this->faker->unique()->safeEmail,
            'password'      => $this->faker->password(8),
            'referral_code' => Str::random(8),
        ];

        $user = factory(User::class)->create();

        $referralProgramUserData = [
            'user_id'             => $user->id,
            'referral_program_id' => ReferralProgram::where('slug',ReferralProgram::REFERRAL_PROGRAM_QUARTER_PERCENT_OF_FIRST_LOAN)->first()->id,
        ];

        $data['partner_type']  = $this->partnerType->id;
        $data['contract_type'] =  $this->contractType->id;

        factory(PartnerProfile::class)
            ->create([
                'user_id'          => $user->id,
                'partner_type_id'  => $this->partnerType->id,
                'contract_type_id' => $this->contractType->id,
            ]);

        $referralProgramUser = factory(ReferralProgramUser::class)
            ->create($referralProgramUserData);


        $this->userRepo->shouldReceive('createAsPartnerWithPartnerProfile')
            ->once()
            ->with($data)
            ->andReturn($user);
//
        $this->expectsRepository(ReferralProgramUserRepositoryInterface::class)
            ->shouldReceive('createQuarterPercentOfFirstLoan')
            ->once()
            ->andReturn($referralProgramUser);

        $this->actingAs($this->admin)
            ->from(route('admin.partner.create'))
            ->post(route('admin.partner.store'), $data)
            ->assertRedirect(route('admin.partner.create'))
            ->assertSessionHas('message','New user: [' . $user->name . '] created successfully as partner !');
    }

    /**
     * @test
     */
    public function it_should_create_partner_profile_without_referral_program_user_if_contract_type_is_not_campus_ambassador()
    {
        $this->withoutExceptionHandling();

        $data = [
            'name'          => $this->faker->firstName,
            'email'         => $this->faker->unique()->safeEmail,
            'password'      => $this->faker->password(8),
            'referral_code' => Str::random(8),
        ];

        $user = factory(User::class)->create();

        $data['partner_type']  = $this->partnerType->id;
        $data['contract_type'] =  factory(ContractType::class)->create([
            'type' => $this->faker->words(3, true),
        ])->id;

        factory(PartnerProfile::class)
            ->create([
                'user_id'          => $user->id,
                'partner_type_id'  => $this->partnerType->id,
                'contract_type_id' => $data['contract_type'],
            ]);

        $this->userRepo->shouldReceive('createAsPartnerWithPartnerProfile')
            ->once()
            ->with($data)
            ->andReturn($user);

        $this->expectsRepository(ReferralProgramUserRepositoryInterface::class)
            ->shouldNotHaveReceived('createQuarterPercentOfFirstLoan');

        $this->actingAs($this->admin)
            ->from(route('admin.partner.create'))
            ->post(route('admin.partner.store'), $data)
            ->assertRedirect(route('admin.partner.create'))
            ->assertSessionHas('message','New user: [' . $user->name . '] created successfully as partner !');
    }

    /**
     * @test
     */
    public function it_should_create_partner_profile_without_referral_program_user_if_partner_type_is_not_campus_ambassador()
    {
        $data = [
            'name'          => $this->faker->firstName,
            'email'         => $this->faker->unique()->safeEmail,
            'password'      => $this->faker->password(8),
            'referral_code' => Str::random(8),
            'partner_type'  => factory(PartnerType::class)->create([
                'type' => $this->faker->words(3, true),
            ])->id,
            'contract_type' => $this->contractType->id,
        ];

        $user = factory(User::class)->create();

        $data['partner_type']  = factory(PartnerType::class)->create([
            'type' => $this->faker->words(3, true),
        ])->id;
        $data['contract_type'] = $this->contractType->id;

        factory(PartnerProfile::class)
            ->create([
                'user_id'          => $user->id,
                'partner_type_id'  => $data['partner_type'],
                'contract_type_id' => $this->contractType->id,
            ]);

        $this->userRepo->shouldReceive('createAsPartnerWithPartnerProfile')
            ->once()
            ->with($data)
            ->andReturn($user);

        $this->expectsRepository(ReferralProgramUserRepositoryInterface::class)
            ->shouldNotHaveReceived('createQuarterPercentOfFirstLoan');

        $this->actingAs($this->admin)
            ->from(route('admin.partner.create'))
            ->post(route('admin.partner.store'), $data)
            ->assertRedirect(route('admin.partner.create'))
            ->assertSessionHas('message','New user: [' . $user->name . '] created successfully as partner !');
    }

    /**
     * @test
     */
    public function it_should_fail_with_validation_errors()
    {
        $this->expectException(ValidationException::class);
        $this->actingAs($this->admin)
            ->from(route('admin.partner.create'))
            ->post(route('admin.partner.store'), [])
            ->assertRedirect(route('admin.partner.create'))
            ->assertJsonValidationErrors('The given data was invalid');

        $this->assertDatabaseCount('referral_program_users', 0);
    }

    /**
     * @test
     */
    public function it_should_create_new_partner_type()
    {
        $data = [
            'type' => $this->faker->words(3, true),
        ];

        $partnerProfile = factory(PartnerType::class)->create([
            'type' => $this->faker->words(3, true),
        ]);

        $this->partnerTypeRepo
            ->shouldReceive('store')
            ->with($data)
            ->once()
            ->andReturn($partnerProfile);

        $this->actingAs($this->admin)
            ->from(route('admin.partner.create'))
            ->post(route('admin.partner-type.store'), $data)
            ->assertRedirect(route('admin.partner.create'));
    }

    /**
     * @test
     */
    public function it_should_create_new_contract_type()
    {
        $data = [
            'type' => $this->faker->words(3, true),
        ];

        $contractType = factory(ContractType::class)->create([
            'type' => $this->faker->words(3, true)
        ]);

        $this->contractTypeRepo
            ->shouldReceive('store')
            ->with($data)
            ->once()
            ->andReturn($contractType);

        $this->actingAs($this->admin)
            ->from(route('admin.partner.create'))
            ->post(route('admin.contract-type.store'), $data)
            ->assertRedirect(route('admin.partner.create'));
    }

    /**
     * @test
     */
    public function it_should_fail_creating_partner_type_with_validation_errors()
    {
        $this->expectException(ValidationException::class);
        $this->actingAs($this->admin)
            ->from(route('admin.partner.create'))
            ->post(route('admin.partner-type.store'), [])
            ->assertRedirect(route('admin.partner.create'))
            ->assertJsonValidationErrors('The given data was invalid');
    }

    /**
     * @test
     */
    public function it_should_fail_creating_contract_type_with_validation_errors()
    {
        $this->expectException(ValidationException::class);
        $this->actingAs($this->admin)
            ->from(route('admin.partner.create'))
            ->post(route('admin.contract-type.store'), [])
            ->assertRedirect(route('admin.partner.create'))
            ->assertJsonValidationErrors('The given data was invalid');
    }
}
