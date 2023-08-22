<?php

namespace Tests\Feature\Controllers;

use App\Models\Component;
use App\Models\Inspection;
use App\Models\Turbine;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class TurbineControllerTest extends TestCase
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
        $response = $this->get('/api/turbines');

        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'name', 'farm_id', 'lat', 'lng', 'created_at', 'updated_at',
                ],
            ],
        ]);
    }

    public function test_by_id()
    {
        $turbine = Turbine::first();

        $response = $this->get("/api/turbines/{$turbine->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'farm_id', 'lat', 'lng', 'created_at', 'updated_at',
                ],
            ])
            ->assertJsonPath('data.name', $turbine->name)
            ->assertJsonPath('data.id', $turbine->id);
    }

     public function test_inspection_by_id()
     {
         $turbine = Turbine::first();
         $inspection = Inspection::where('turbine_id', $turbine->id)->first();

         $response = $this->get("/api/turbines/{$turbine->id}/inspections/{$inspection->id}");

         $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                     'id',
                     'turbine_id',
                     'inspected_at',
                 ],
             ])
             ->assertJsonPath('data.id', $inspection->id)
             ->assertJsonPath('data.turbine_id', $inspection->turbine_id)
             ->assertJsonPath('data.inspected_at', $inspection->inspected_at);
     }

    public function test_by_inspections()
    {
        $turbine = Turbine::first();
        $inspections = $turbine->inspections;

        $response = $this->get("/api/turbines/{$turbine->id}/inspections");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'turbine_id', 'inspected_at',
                    ],
                ],
            ]);

        // A further step to check that the turbines are indeed the correct ones.
        $responseData = $response->decodeResponseJson()['data'];
        $this->assertCount($inspections->count(), $responseData);
        foreach ($responseData as $index => $inspectionData) {
            $turbine = $inspections[$index];
            $this->assertEquals($turbine->id, $inspectionData['id']);
            $this->assertEquals($turbine->turbine_id, $inspectionData['turbine_id']);
            $this->assertEquals($turbine->inspected_at, $inspectionData['inspected_at']);
        }
    }

    public function test_component_by_id()
    {
        $turbine = Turbine::first();
        $component = Component::where('turbine_id', $turbine->id)->first();

        $response = $this->get("/api/turbines/{$turbine->id}/components/{$component->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'component_type_id',
                    'turbine_id',
                ],
            ])
            ->assertJsonPath('data.id', $component->id)
            ->assertJsonPath('data.component_type_id', $component->component_type_id)
            ->assertJsonPath('data.turbine_id', $component->turbine_id);
    }

    public function test_by_components()
    {
        $turbine = Turbine::first();
        $components = $turbine->components;

        $response = $this->get("/api/turbines/{$turbine->id}/components");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'component_type_id', 'turbine_id', 'created_at', 'updated_at',
                    ],
                ],
            ]);

        // A further step to check that the turbines are indeed the correct ones.
        $responseData = $response->decodeResponseJson()['data'];
        $this->assertCount($components->count(), $responseData);
        foreach ($responseData as $index => $componentData) {
            $turbine = $components[$index];
            $this->assertEquals($turbine->id, $componentData['id']);
            $this->assertEquals($turbine->component_type_id, $componentData['component_type_id']);
            $this->assertEquals($turbine->turbine_id, $componentData['turbine_id']);
        }
    }
}
