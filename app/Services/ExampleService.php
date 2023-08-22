<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Example use cases for Search as I didn't need to use this layer for the technical test.
 */
class ExampleSearch
{
    /**
     * Perform a search on the User model by name.
     *
     * @return Collection
     */
    public function searchUsersByName(string $searchTerm)
    {
        // Commenting the old search method.
        // return User::where('name', 'like', '%' . $searchTerm . '%')->get();

        // Using Laravel Scout with MeiliSearch to search.
        // User::search($searchTerm)->get();
        // could implement pagination too
        // caching
    }

    public function searchFarmsByName()
    {
        //
    }

    public function searchFarmsByLocation()
    {
        // lat & lng maths
        // may need another service class for an external API to get location etc
    }
}
