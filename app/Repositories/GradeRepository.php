<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Component;
use App\Models\Inspection;

interface GradeRepository
{
    public function getALL();

    public function getByID(int $gradeID);

    // TODO: Remove Laravel Eloquent Model
    public function getALLByComponent(Component $component);

    // TODO: Remove Laravel Eloquent Model
    public function getALLByInspection(Inspection $inspection);

    public function getTypeByID($typeID);

    public function types();
}
