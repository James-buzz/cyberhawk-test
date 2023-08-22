<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Inspection;
use App\Repositories\InspectionRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentInspectionRepository implements InspectionRepository
{
    /**
     * Retrieve the defined types of grades.
     * E.g. Rotor, Hub, etc
     */
    public function getALL(): Collection
    {
        return Inspection::all();
    }

     /**
      * Retrieve a specific inspection by its unique ID.
      */
     public function getByID($inspectionID): Inspection
     {
         return Inspection::findOrFail($inspectionID);
     }
}
