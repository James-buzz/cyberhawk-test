<?php

namespace Database\Factories;

use App\Models\Component;
use App\Models\Grade;
use App\Models\GradeType;
use App\Models\Inspection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    protected $model = Grade::class;

    public function definition()
    {
        return [
            'inspection_id' => Inspection::all()->random()->id,
            'component_id' => Component::all()->random()->id,
            'grade_type_id' => GradeType::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
