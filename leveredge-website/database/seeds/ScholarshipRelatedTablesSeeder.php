<?php

use App\Scholarship;
use App\ScholarshipContent;
use App\ScholarshipQuestion;
use App\ScholarshipTemplate;
use App\ScholarshipWinner;
use Illuminate\Database\Seeder;

class ScholarshipRelatedTablesSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = \Faker\Factory::create();

        // Create a Scholarship Template
        $scholarshipTemplate               = new ScholarshipTemplate();
        $scholarshipTemplate->name         = 'Test Template';
        $scholarshipTemplate->view         = 'version-1';
        $scholarshipTemplate->success_view = 'version-1';
        $scholarshipTemplate->save();

        // Create a Scholarship Based on the Template
        $scholarship                          = new Scholarship();
        $scholarship->scholarship_template_id = $scholarshipTemplate->id;
        $scholarship->name                    = 'July Month Scholarship';
        $scholarship->slug                    = 'july-month-scholarship';
        $scholarship->save();

        // Add a question to the scholarship
        $scholarshipQuestion                   = new ScholarshipQuestion();
        $scholarshipQuestion->scholarship_id   = $scholarship->id;
        $scholarshipQuestion->label            = 'Can you tell me about your life?';
        $scholarshipQuestion->type             = 'long-text';
        $scholarshipQuestion->field_name       = 'essay';
        $scholarshipQuestion->validation_rules = 'required|min:500';
        $scholarshipQuestion->save();

        // Add some content to the scholarship
        $scholarshipContent                 = new ScholarshipContent();
        $scholarshipContent->scholarship_id = $scholarship->id;
        $scholarshipContent->type           = 'Text Area';
        $scholarshipContent->name           = 'description';
        $scholarshipContent->body           = $this->faker->paragraph . '<br>' . $this->faker->paragraph;
        $scholarshipContent->save();

        // Add some scholarship  winners to the scholarship
        for ($i = 0; $i < 5; $i++) {
            $scholarshipWinner                  = new ScholarshipWinner();
            $scholarshipWinner->scholarship_id  = $scholarship->id;
            $scholarshipWinner->title           = $this->faker->month . ' Winner';
            $scholarshipWinner->name            = $this->faker->name;
            $scholarshipWinner->photo           = 'https://via.placeholder.com/480x480.png?text=Random+Person+Image';
            $scholarshipWinner->university      = $this->faker->word . ' University';
            $scholarshipWinner->year            = 'Class of ' . $this->faker->year;
            $scholarshipWinner->save();
        }
    }
}
