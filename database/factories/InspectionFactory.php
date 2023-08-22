<?php

namespace Database\Factories;

use App\Models\Inspection;
use App\Models\Turbine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inspection>
 */
class InspectionFactory extends Factory
{
    protected $model = Inspection::class;

    public function definition()
    {
        return [
            'turbine_id' => Turbine::all()->random()->id,
            'inspected_at' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
