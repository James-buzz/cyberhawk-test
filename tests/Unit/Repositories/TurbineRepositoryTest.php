<?php

namespace Tests\Unit\Repositories;

use App\Models\Component;
use App\Models\Farm;
use App\Models\Inspection;
use App\Models\Turbine;
use App\Repositories\TurbineRepository;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class TurbineRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_get_all()
    {
        $turbines = app(TurbineRepository::class)->getAll();

        $allTurbines = Turbine::count();

        $this->assertEquals($allTurbines, $turbines->count());
    }

    public function test_by_id()
    {
        $turbine = Turbine::first();

        $retrievedTurbine = app(TurbineRepository::class)->getByID($turbine->id);

        $this->assertEquals($turbine->id, $retrievedTurbine->id);
    }

    public function test_by_invalid_id()
    {
        $this->expectException(ModelNotFoundException::class);

        app(TurbineRepository::class)->getByID(999999);
    }

    public function test_by_get_all_by_farm()
    {
        $farm = Farm::first();
        $countDBTurbines = Turbine::where('farm_id', $farm->id)->count();

        $retrieveTurbines = app(TurbineRepository::class)->getALLByFarm($farm);

        $this->assertCount($countDBTurbines, $retrieveTurbines);
    }

    public function test_get_components_by_turbine()
    {
        $turbine = Turbine::first();
        $components = Component::where('turbine_id', $turbine->id)->get();

        $retrieveComponents = app(TurbineRepository::class)->getComponentsByTurbine($turbine);

        $this->assertEquals($components->count(), $retrieveComponents->count());
        foreach ($components as $index => $component) {
            $this->assertEquals($component->toArray(), $retrieveComponents[$index]->toArray());
        }
    }

    public function test_get_inspection_by_turbine()
    {
        $turbine = Turbine::first();
        $inspections = Inspection::where('turbine_id', $turbine->id)->get();

        $retrieveInspections = app(TurbineRepository::class)->getInspectionsByTurbine($turbine);

        $this->assertEquals($inspections->count(), $retrieveInspections->count());
        foreach ($inspections as $index => $inspection) {
            $this->assertEquals($inspection->toArray(), $retrieveInspections[$index]->toArray());
        }
    }
}
