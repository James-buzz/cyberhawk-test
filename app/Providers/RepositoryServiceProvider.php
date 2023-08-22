<?php

namespace App\Providers;

use App\Repositories\ComponentRepository;
use App\Repositories\Eloquent\EloquentComponentRepository;
use App\Repositories\Eloquent\EloquentFarmRepository;
use App\Repositories\Eloquent\EloquentGradeRepository;
use App\Repositories\Eloquent\EloquentInspectionRepository;
use App\Repositories\Eloquent\EloquentTurbineRepository;
use App\Repositories\FarmRepository;
use App\Repositories\GradeRepository;
use App\Repositories\InspectionRepository;
use App\Repositories\TurbineRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ComponentRepository::class, EloquentComponentRepository::class);
        $this->app->bind(FarmRepository::class, EloquentFarmRepository::class);
        $this->app->bind(GradeRepository::class, EloquentGradeRepository::class);
        $this->app->bind(InspectionRepository::class, EloquentInspectionRepository::class);
        $this->app->bind(TurbineRepository::class, EloquentTurbineRepository::class);
    }
}
