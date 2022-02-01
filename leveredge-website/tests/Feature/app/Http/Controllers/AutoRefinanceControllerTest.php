<?php


namespace Tests\Feature\app\Http\Controllers;

use App\Client;
use App\Experiment;
use App\ExperimentType;
use App\Faq;
use App\FaqGroup;
use App\User;
use App\UserClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Feature\FeatureTest;

class AutoRefinanceControllerTest extends FeatureTest
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed',['--class' => \ExperimentTypeTableSeeder::class]);
        $this->artisan('db:seed',['--class' => \ExperimentTableSeeder::class]);
    }

    /**
     * @test
     */
    public function it_should_redirect_to_next_active_version_on_every_subsequent_request()
    {
        //In database (seeded) only v6,v8 and v9 are currently active
        //Each new request creating new client_id

        $this->get('/loans/auto-refinance')
            ->assertRedirect('loans/auto-refinance/v6');

        $this->get('/loans/auto-refinance')
            ->assertRedirect('loans/auto-refinance/v8');

        $this->get('/loans/auto-refinance')
            ->assertRedirect('loans/auto-refinance/v9');

        $this->get('/loans/auto-refinance')
            ->assertRedirect('loans/auto-refinance/v6');

        $this->get('/loans/auto-refinance')
            ->assertRedirect('loans/auto-refinance/v8');
    }

    /**
     * @test
     */
    public function it_should_redirect_to_same_active_version_on_very_subsequent_request_with_existing_user()
    {
        $user   = factory(User::class)->create();
        $client = factory(Client::class)->create();
        factory(UserClient::class)->create([
            'user_id'   => $user->id,
            'client_id' => $client->id,
        ]);

        $this->actingAs($user);
        // auto refi v8 is the first active experiment in database

        $this->withUnencryptedCookies(['client_id' => $client->id])
            ->get('/loans/auto-refinance')
            ->assertRedirect('loans/auto-refinance/v9');

        $this->withUnencryptedCookies(['client_id' => $client->id])
            ->get('/loans/auto-refinance')
            ->assertRedirect('loans/auto-refinance/v9');

        $this->withUnencryptedCookies(['client_id' => $client->id])
            ->get('/loans/auto-refinance')
            ->assertRedirect('loans/auto-refinance/v9');
    }

    /**
     * @test
     */
    public function it_should_show_default_page_when_there_is_no_experiment_matching()
    {
        $this->withoutExceptionHandling();
        //mark all experiments as non active
        DB::statement('UPDATE experiments set `active` = 0');

        factory(Experiment::class)->create([
            'experiment_type_id' => ExperimentType::AUTO_REFINANCE_LANDING_PAGE,
        ]);
        factory(Experiment::class)->create([
            'experiment_type_id' => ExperimentType::AUTO_REFINANCE_SIGN_UP,
        ]);
        factory(FaqGroup::class, 20)->create();
        $faq = factory(Faq::class)->create();
        DB::table('frequently_asked_group_questions')->insert([
            'faq_group_id' => 24,
            'faq_id'       => $faq->id,
        ]);

        $this->get('/loans/auto-refinance')
            ->assertViewIs('landing-pages.auto-refinance.auto-refinance');
    }
}
