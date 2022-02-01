<?php

use App\PageSection;
use Illuminate\Database\Seeder;

class PageSectionsTableSeeder extends Seeder
{
    public function run()
    {
        $page_sections = config('page_sections');

        foreach ($page_sections as $page => $sections) {

            array_walk($sections, function ($section) use ($page) {
                PageSection::query()->updateOrCreate([
                    'target_page'  => $page,
                    'section_name' => $section,
                ]);
            });

        }
    }
}
