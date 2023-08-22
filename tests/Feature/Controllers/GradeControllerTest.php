<?php

namespace Tests\Feature\Controllers;

use App\Models\Grade;
use App\Models\GradeType;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class GradeControllerTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class); // Fills the database with sample data
    }

    public function test_index()
    {
        $response = $this->get('/api/grades');

        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'inspection_id',
                    'component_id',
                    'grade_type_id',
                ],
            ],
        ]);
    }

    public function test_by_id()
    {
        $grade = Grade::first();

        $response = $this->get("/api/grades/{$grade->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'inspection_id',
                    'component_id',
                    'grade_type_id',
                ],
            ])
            ->assertJsonPath('data.inspection_id', $grade->inspection_id);
    }

   public function test_types()
   {
       $response = $this->get('/api/grade-types');

       $response->assertStatus(200)
       ->assertJsonStructure([
           'data' => [
               '*' => [
                   'id',
                   'name',
               ],
           ],
       ]);
   }

    public function test_type_by_id()
    {
        $gradeType = GradeType::first();

        $response = $this->get("/api/grade-types/{$gradeType->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ])
            ->assertJsonPath('data.name', $gradeType->name);
    }
}
