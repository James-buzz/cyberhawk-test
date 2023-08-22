<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Farm;
use App\Repositories\FarmRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentFarmRepository implements FarmRepository
{
    /**
     * Retrieve all the farms.
     */
    public function getALL(): Collection
    {
        return Farm::all();
    }

    /**
     * Retrieve a single farm by its id.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getByID(int $farmID): Farm
    {
        $farm = Farm::findOrFail($farmID);

        return $farm;
    }
}
