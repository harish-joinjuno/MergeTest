<?php

namespace Tests\Feature\app\Http\Controllers\Admin;

use App\Exports\MagicLoginLinksExport;
use App\MagicLoginLink;
use App\Repositories\Contracts\MagicLoginLinkRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Tests\Feature\AdminFeatureTest;

class MagicLinkExportControllerTest extends AdminFeatureTest
{
    protected $repo;

    public function setUp(): void
    {
        parent::setUp();

        $this->repo = $this->expectsRepository(MagicLoginLinkRepositoryInterface::class);
    }

    /**
     * @test
     */
    public function it_should_render_magic_login_links_export_page()
    {
        $this->repo->shouldReceive('all')
            ->once()
            ->andReturn(new Collection());

        $response = $this->actingAs($this->admin)
            ->get(route('admin.magic-links'));
        $response->assertViewIs('admin.exports.magic-links');
        $response->assertViewHas('magicLoginLinks', new Collection());
    }

    /**
     * @test
     */
    public function it_should_download_magic_login_links()
    {
        $this->withoutExceptionHandling();
        $magicLoginLink = factory(MagicLoginLink::class)->create();
        $this->repo->shouldReceive('exportAsCsv');
        $response       = $this->actingAs($this->admin)
            ->post(route('admin.magic-links.download'), [
                'magic_login_link_id' => $magicLoginLink->id,
            ]);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_should_fail_when_magic_login_link_is_not_present()
    {
        $this->expectException(ValidationException::class);
        $response = $this->actingAs($this->admin)
            ->from(route('admin.magic-links'))
            ->post(route('admin.magic-links.download'), []);

        $response->assertJsonValidationErrors('The given data was invalid');
        $this->assertValidationError('magic_login_link_id','magic_login_link_id is requred');
    }

    /**
     * @test
     */
    public function it_should_fail_when_magic_login_link_id_does_not_exist()
    {
        $this->expectException(ValidationException::class);
        $response = $this->actingAs($this->admin)
            ->from(route('admin.magic-links'))
            ->post(route('admin.magic-links.download'), [
                'magic_login_link_id' => 100,
            ]);

        $response->assertJsonValidationErrors('The given data was invalid');
    }
}
