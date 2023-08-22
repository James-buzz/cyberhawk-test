<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Component;
use App\Models\ComponentType;
use App\Repositories\ComponentRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentComponentRepository implements ComponentRepository
{
    /**
     * Retrieve all components.
     */
    public function getALL(): Collection
    {
        return Component::all();
    }

    /**
     * Retrieve the defined types of components.
     * E.g. Rotor, Hub, etc
     */
    public function types(): Collection
    {
        return ComponentType::all();
    }

     /**
      * Retrieve a specific type by its unique ID.
      */
     public function getTypeByID($typeID): ComponentType
     {
         return ComponentType::findOrFail($typeID);
     }

    /**
     * Retrieve a specific component by it's unique ID.
     */
    public function getByID(int $componentID): Component
    {
        $component = Component::findOrFail($componentID);

        return $component;
    }
}
