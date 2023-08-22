<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Component;
use App\Models\ComponentType;
use App\Models\Turbine;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComponentFactory extends Factory
{
    protected $model = Component::class;

    public function definition()
    {
        return [
            'component_type_id' => ComponentType::all()->random()->id,
            'turbine_id' => Turbine::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
