<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Farm;
use App\Models\Turbine;
use App\Repositories\TurbineRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentTurbineRepository implements TurbineRepository
{
    /**
     * Retrieve all the known turbines.
     */
    public function getALL(): Collection
    {
        return Turbine::all();
    }

    /**
     * Retrieve all turbines related to a farm
     */
    public function getALLByFarm(Farm $farm): Collection
    {
        return $farm->turbines;
    }

    /**
     * Retrieve a single turbine by its id.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getByID(int $turbineID): Turbine
    {
        $turbine = Turbine::findOrFail($turbineID);

        return $turbine;
    }

    public function getComponentsByTurbine(Turbine $turbine): Collection
    {
        return $turbine->components;
    }

     public function getInspectionsByTurbine(Turbine $turbine): Collection
     {
         return $turbine->inspections;
     }
}
