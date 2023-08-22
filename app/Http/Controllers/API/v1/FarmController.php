<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Repositories\FarmRepository;
use App\Repositories\TurbineRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class FarmController extends Controller
{
    public function __construct(protected FarmRepository $farmRepository, protected TurbineRepository $turbineRepository)
    {
        // note: dependency injection for repository
    }

    /**
     * Retrieve all the Farms
     */
    public function index(): JsonResponse
    {
        $farms = $this->farmRepository->getALL();

        return response()->json([
            'data' => $farms,
        ], 200);
    }

    /**
     * Find a single Farm by its unique ID
     *
     * @throws ModelNotFoundException If Farm is not found by ID
     */
    public function show(int $farmID): JsonResponse
    {
        $farm = $this->farmRepository->getByID($farmID);

        return response()->json([
            'data' => $farm,
        ], 200);
    }

    /**
     * Display the turbines that are associated with a given farm.
     *
     * @throws ModelNotFoundException If Farm is not found by its ID
     */
    public function turbines(int $farmID): JsonResponse
    {
        $farm = $this->farmRepository->getByID($farmID); // this will throw an exception if farm does not exist
        $turbines = $this->turbineRepository->getALLByFarm($farm);

        return response()->json([
            'data' => $turbines,
        ], 200);
    }

    /**
     * Find the unique turbine identified by the given id.
     *
     * @throws ModelNotFoundException If Turbine is not found by ID or Farm is not found
     */
    public function showTurbine(int $farmID, int $turbineID): JsonResponse
    {
        $this->farmRepository->getByID($farmID);
        $turbine = $this->turbineRepository->getByID($turbineID);

        return response()->json([
            'data' => $turbine,
        ], 200);
    }

    public function create()
    {
        // To add more functionality to the backend API, you could include for a new route that creates the farms.
        // It could utilise Laravel's Request class as 'CreateFarmRequest for validation and if successful, could also
        // raise a new event 'NewFarmEvent' and a listener with usesQueue.
        // This could be used to email an admin account or another queue-based actions.
    }
}
