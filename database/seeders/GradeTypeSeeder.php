<?php

namespace Database\Seeders;

use App\Models\GradeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeTypeSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $grades = collect(['Severe', 'Moderate', 'Minor', 'Light', 'No Wear']);

        $grades->each(function ($grade) {
            GradeType::create([
                'name' => $grade,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
