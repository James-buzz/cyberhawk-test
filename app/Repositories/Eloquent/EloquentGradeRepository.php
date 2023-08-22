<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Component;
use App\Models\Grade;
use App\Models\GradeType;
use App\Models\Inspection;
use App\Repositories\GradeRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentGradeRepository implements GradeRepository
{
    public function getALL(): Collection
    {
        return Grade::all();
    }

    public function getByID(int $gradeID): Grade
    {
        $grade = Grade::findOrFail($gradeID);

        return $grade;
    }

    public function getALLByComponent(Component $component): Collection
    {
        return $component->grades;
    }

    public function getALLByInspection(Inspection $inspection): Collection
    {
        return $inspection->grades;
    }

    /**
     * Retrieve a specific type by its unique ID.
     */
    public function getTypeByID($typeID): GradeType
    {
        return GradeType::findOrFail($typeID);
    }

    /**
     * Retrieve the defined types of grades.
     * E.g. Rotor, Hub, etc
     */
    public function types(): Collection
    {
        return GradeType::all();
    }
}
