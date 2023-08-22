<?php

namespace Tests\Feature\Controllers;

use App\Models\Farm;
use App\Models\Turbine;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class FarmControllerTest extends TestCase
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
        $response = $this->get('/api/farms');

        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }

    public function test_by_id()
    {
        $farm = Farm::first();

        $response = $this->get("/api/farms/{$farm->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJsonPath('data.name', $farm->name);
    }

    public function test_turbine_by_id()
    {
        $farm = Farm::first();
        $turbine = Turbine::where('farm_id', $farm->id)->first();

        $response = $this->get("/api/farms/{$farm->id}/turbines/{$turbine->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'farm_id',
                    'lat',
                    'lng',
                ],
            ])
            ->assertJsonPath('data.id', $turbine->id)
            ->assertJsonPath('data.name', $turbine->name)
            ->assertJsonPath('data.farm_id', $turbine->farm_id)
            ->assertJsonPath('data.lat', $turbine->lat)
            ->assertJsonPath('data.lng', $turbine->lng);
    }

    public function test_by_turbines_by_id()
    {
        $farm = Farm::first();
        $turbines = $farm->turbines;

        $response = $this->get("/api/farms/{$farm->id}/turbines");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'farm_id',
                        'lat',
                        'lng',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);

        // A further step to check that the turbines are indeed the correct ones.
        $responseData = $response->decodeResponseJson()['data'];
        $this->assertCount($turbines->count(), $responseData);
        foreach ($responseData as $index => $turbineData) {
            $turbine = $turbines[$index];
            $this->assertEquals($turbine->id, $turbineData['id']);
            $this->assertEquals($turbine->name, $turbineData['name']);
            $this->assertEquals($turbine->farm_id, $turbineData['farm_id']);
            $this->assertEquals($turbine->lat, $turbineData['lat']);
            $this->assertEquals($turbine->lng, $turbineData['lng']);
        }
    }
}
