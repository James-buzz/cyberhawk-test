<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\ComponentType;
use App\Models\Farm;
use App\Models\Grade;
use App\Models\GradeType;
use App\Models\Inspection;
use App\Models\Turbine;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        $componentTypes = ComponentType::all(); // 'Blade', 'Rotor', 'Hub', 'Generator'
        $gradeTypes = GradeType::all(); // 'Severe', 'Moderate', 'Minor', 'Light', 'No Wear'

        // Create 3 unique farms
        $farms = Farm::factory()->count(3)->create();

        // For each farm, we will create 2 sample turbines with 3 inspection reports for all the components of the turbine
        // I'm assuming that on each inspection all components are surveyed
        foreach ($farms as $farm) {
            $turbines = Turbine::factory()->count(2)
            ->create(['farm_id' => $farm->id]);

            // For each turbine, I'll create one of each type of component to inspect
            foreach ($turbines as $turbine) {
                $components = [];
                foreach ($componentTypes as $componentType) {
                    $components[] = Component::factory()->create(['turbine_id' => $turbine->id, 'component_type_id' => $componentType->id]);
                }

                // Then we will create 3 inspections for each turbine.
                $inspections = Inspection::factory()->count(3)->create(['turbine_id' => $turbine->id]);

                // Then we'll create a grade for each component of the 3 inspections
                foreach ($inspections as $inspection) {
                    foreach ($components as $component) {
                        // Create a grade for each component in each inspection.
                        Grade::factory()->create([
                            'inspection_id' => $inspection->id,
                            'component_id' => $component->id,
                            'grade_type_id' => $gradeTypes->random()->id,
                        ]);
                    }
                }
            }
        }
    }
}
