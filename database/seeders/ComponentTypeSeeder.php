<?php

namespace Database\Seeders;

use App\Models\ComponentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentTypeSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $types = collect(['Blade', 'Rotor', 'Hub', 'Generator']);

        $types->each(function ($grade) {
            ComponentType::create([
                'name' => $grade,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
