<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Farm;
use App\Models\Turbine;

interface TurbineRepository
{
    public function getALL();

    // TODO: remove laravel model
    public function getALLByFarm(Farm $farm);

    public function getByID(int $turbineID);

    // TODO: remove laravel model
    public function getComponentsByTurbine(Turbine $turbine);

    // TODO: remove laravel model
    public function getInspectionsByTurbine(Turbine $turbine);
}
