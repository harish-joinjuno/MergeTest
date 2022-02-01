<?php

namespace Tests\Feature\app\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use Tests\Builders\RoleBuilder;
use Tests\Builders\UserBuilder;
use Tests\Feature\AdminFeatureTest;
use Tests\Feature\FeatureTest;
use Tests\TestCase;

class AccessTheDealControllerTest extends AdminFeatureTest
{
    /**
     * @test
     */
    public function it_should_render_admin_access_the_deals_view()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.imports.access-the-deals'));

        $response->assertViewIs('admin.imports.access-the-deals');
    }

    /**
     * @test
     */
    public function it_should_download_access_the_deals_import_template()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.imports.access-the-deals-template'));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_should_upload_access_the_deals()
    {
        Storage::fake();

        $file = new UploadedFile(base_path('tests/FileForUploads/update_access_the_deals.csv'),'update_access_the_deals.csv');

        $response = $this->actingAs($this->admin)
            ->from(route('admin.imports.access-the-deals'))
            ->json('POST', route('admin.imports.access-the-deals.upload'), [
                'template_file' => $file,
            ]);

        $response->assertRedirect(route('admin.imports.access-the-deals'));
    }
}
