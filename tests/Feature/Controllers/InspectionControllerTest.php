<?php

namespace Tests\Feature\Controllers;

use App\Models\Grade;
use App\Models\Inspection;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class InspectionControllerTest extends TestCase
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
        $response = $this->get('/api/inspections');

        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'turbine_id',
                    'inspected_at',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }

    public function test_by_id()
    {
        $inspection = Inspection::first();

        $response = $this->get("/api/inspections/{$inspection->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'turbine_id',
                    'inspected_at',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJsonPath('data.name', $inspection->name);
    }

    public function test_turbine_by_id()
    {
        $inspection = Inspection::first();
        $grade = Grade::where('inspection_id', $inspection->id)->first();

        $response = $this->get("/api/inspections/{$inspection->id}/grades/{$grade->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'inspection_id',
                    'component_id',
                    'grade_type_id',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJsonPath('data.id', $grade->id)
            ->assertJsonPath('data.inspection_id', $grade->inspection_id)
            ->assertJsonPath('data.component_id', $grade->component_id)
            ->assertJsonPath('data.grade_type_id', $grade->grade_type_id);
    }

    public function test_by_turbines_by_id()
    {
        $inspection = Inspection::first();
        $grades = $inspection->grades;

        $response = $this->get("/api/inspections/{$inspection->id}/grades");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'inspection_id',
                        'component_id',
                        'grade_type_id',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);

        // A further step to check that the turbines are indeed the correct ones.
        $responseData = $response->decodeResponseJson()['data'];
        $this->assertCount($grades->count(), $responseData);
        foreach ($responseData as $index => $gradeData) {
            $grade = $grades[$index];
            $this->assertEquals($grade->id, $gradeData['id']);
            $this->assertEquals($grade->inspection_id, $gradeData['inspection_id']);
            $this->assertEquals($grade->component_id, $gradeData['component_id']);
            $this->assertEquals($grade->grade_type_id, $gradeData['grade_type_id']);
        }
    }
}
