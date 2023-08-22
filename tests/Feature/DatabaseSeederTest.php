<?php

namespace Tests\Feature;

use App\Models\Component;
use App\Models\ComponentType;
use App\Models\Farm;
use App\Models\Grade;
use App\Models\GradeType;
use App\Models\Inspection;
use App\Models\Turbine;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeding()
    {
        // Count the initial number of records
        $initialGradeTypeCount = GradeType::count();
        $initialComponentTypeCount = ComponentType::count();
        $initialFarmCount = Farm::count();
        $initialTurbineCount = Turbine::count();
        $initialComponentCount = Component::count();
        $initialInspectionCount = Inspection::count();
        $initialGradeCount = Grade::count();

        $this->seed(DatabaseSeeder::class);

        // TODO: fix with rand

        // Now assert that the number of records has increased as expected
        $this->assertEquals($initialGradeTypeCount + 5, GradeType::count());
        $this->assertEquals($initialComponentTypeCount + 4, ComponentType::count());
        $this->assertEquals($initialFarmCount + 3, Farm::count());
        $this->assertEquals($initialTurbineCount + 6, Turbine::count()); // 2 turbines per farm, and 3 farms
        $this->assertEquals($initialComponentCount + 24, Component::count()); // 4 components per turbine, and 6 turbines
        $this->assertEquals($initialInspectionCount + 18, Inspection::count()); // 3 inspections per turbine, and 6 turbines
        $this->assertEquals($initialGradeCount + 72, Grade::count()); // 1 grade per component per inspection, and 24 components and 3 inspections
    }
}
