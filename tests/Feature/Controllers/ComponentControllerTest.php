<?php

namespace Tests\Feature\Controllers;

use App\Models\Component;
use App\Models\ComponentType;
use App\Models\Grade;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class ComponentControllerTest extends TestCase
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
        $response = $this->get('/api/components');

        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'component_type_id',
                    'turbine_id',
                ],
            ],
        ]);
    }

    public function test_by_id()
    {
        $component = Component::first();

        $response = $this->get("/api/components/{$component->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'component_type_id',
                    'turbine_id',
                ],
            ])
            ->assertJsonPath('data.component_type_id', $component->component_type_id);
    }

    public function test_types()
    {
        $response = $this->get('/api/component-types');

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
        $componentType = ComponentType::first();

        $response = $this->get("/api/component-types/{$componentType->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ])
            ->assertJsonPath('data.name', $componentType->name);
    }

    public function test_component_id_grades()
    {
        $component = Component::first();
        $response = $this->get("/api/components/{$component->id}/grades");

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

    public function test_by_grade_id_components()
    {
        $component = Component::first();
        $grade = Grade::where('component_id', $component->id)->first();

        $response = $this->get("/api/components/{$component->id}/grades/{$grade->id}");

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
}
