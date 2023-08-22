<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Farm;
use App\Models\Turbine;
use Illuminate\Database\Eloquent\Factories\Factory;

class TurbineFactory extends Factory
{
    protected $model = Turbine::class;

    public function definition(): array
    {
        $letters = range('A', 'Z');
        $numbers = range(1, 100);

        $randomLetter = $letters[array_rand($letters)];
        $randomNumber = $numbers[array_rand($numbers)];

        return [
            'name' => "Turbine $randomLetter$randomNumber",
            'farm_id' => Farm::all()->random()->id,
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
