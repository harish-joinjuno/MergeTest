<?php


namespace Tests\Feature\app\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\FeatureTest;

class WelcomeControllerTest extends FeatureTest
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
    public function it_should_redirect_to_next_active_temple_experiment()
    {
        //In database (seeded) only control (no version) and v2 are currently active
        //Each new request creating new client_id

        $this->get('/loans/undergraduate/temple')
            ->assertViewIs('landing-pages.temple.undergrad');

        $this->get('/loans/undergraduate/temple')
            ->assertRedirect('/loans/undergraduate/temple/v2');
    }

    /**
     * @test
     */
    public function it_should_redirect_to_next_active_refinance_experiment()
    {
        //In database (seeded) only control v4,v6,v7 and v8 are currently active
        //Each new request creating new client_id

        $this->get('/loans/refinance')
            ->assertRedirect('/loans/refinance/v4');

        $this->get('/loans/refinance')
            ->assertRedirect('/loans/refinance/v6');

        $this->get('/loans/refinance')
            ->assertRedirect('/loans/refinance/v7');

        $this->get('/loans/refinance')
            ->assertRedirect('/loans/refinance/v8');

        $this->get('/loans/refinance')
            ->assertRedirect('/loans/refinance/v4');
    }
}
