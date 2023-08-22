<?php

namespace Database\Factories;

use App\Models\Farm;
use Illuminate\Database\Eloquent\Factories\Factory;

class FarmFactory extends Factory
{
    protected $model = Farm::class;

    public function definition()
    {
        $farmNames = [
            'Smith Farms',
            'Johnson Orchards',
            'Williams Ranch',
            'Brown Pastures',
            'Jones Fields',
            'Miller Homestead',
            'Davis Meadows',
            'Wilson Greenhouse',
            'Moore Farms',
            'Taylor Plantation',
            'Anderson Vineyard',
            'Thomas Farmstead',
            'Jackson Poultry',
            'White Gardens',
            'Harris Ranch',
            'Martin Orchards',
            'Thompson Greenhouse',
            'Garcia Farms',
            'Martinez Vineyard',
            'Robinson Ranch',
        ];
        $randomElement = $farmNames[array_rand($farmNames)];

        return [
            'name' => $randomElement,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
