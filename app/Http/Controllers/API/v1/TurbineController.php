<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Repositories\ComponentRepository;
use App\Repositories\InspectionRepository;
use App\Repositories\TurbineRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class TurbineController extends Controller
{
    public function __construct(protected ComponentRepository $componentRepository, protected TurbineRepository $turbineRepository, protected InspectionRepository $inspectionRepository)
    {
    }

    /**
     * Retrieves all the Turbines
     */
    public function index(): JsonResponse
    {
        $turbines = $this->turbineRepository->getALL();

        return response()->json([
            'data' => $turbines,
        ], 200);
    }

    /**
     * Finds a single Turbine by its unique ID
     *
     * @throws ModelNotFoundException If Turbine is not found by ID
     */
    public function show(int $turbineID): JsonResponse
    {
        $turbine = $this->turbineRepository->getByID($turbineID);

        return response()->json([
            'data' => $turbine,
        ], 200);
    }

    /**
     * Finds all associated Components with a Turbine
     *
     * @throws ModelNotFoundException If Turbine is not found by ID
     */
    public function components(int $turbineID): JsonResponse
    {
        $turbine = $this->turbineRepository->getByID($turbineID);
        $components = $this->turbineRepository->getComponentsByTurbine($turbine);

        return response()->json([
            'data' => $components,
        ], 200);
    }

    /**
     * Finds a single associated Component by ID with a Turbine
     *
     * @throws ModelNotFoundException If Turbine is not found by ID or Component is not found by ID
     */
    public function showComponent(int $turbineID, int $componentID): JsonResponse
    {
        $this->turbineRepository->getByID($turbineID);
        $component = $this->componentRepository->getByID($componentID);

        return response()->json([
            'data' => $component,
        ], 200);
    }

    /**
     * Finds all associated Inspections with a Turbine
     *
     * @throws ModelNotFoundException If Turbine is not found by ID
     */
    public function inspections(int $turbineID): JsonResponse
    {
        $turbine = $this->turbineRepository->getByID($turbineID);
        $inspections = $this->turbineRepository->getInspectionsByTurbine($turbine);

        return response()->json([
            'data' => $inspections,
        ], 200);
    }

    /**
     * Finds a single associated Inspection by ID with a Turbine
     *
     * @throws ModelNotFoundException If Turbine is not found by ID or Inspection is not found by ID
     */
    public function showInspection(int $turbineID, int $inspectionID): JsonResponse
    {
        $this->turbineRepository->getByID($turbineID);
        $inspection = $this->inspectionRepository->getByID($inspectionID);

        return response()->json([
            'data' => $inspection,
        ], 200);
    }
}
