<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Repositories\ComponentRepository;
use App\Repositories\GradeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ComponentController extends Controller
{
    public function __construct(protected ComponentRepository $componentRepository, protected GradeRepository $gradeRepository)
    {
    }

    /**
     * Retrieve all Components
     */
    public function index(): JsonResponse
    {
        $components = $this->componentRepository->getALL();

        return response()->json([
            'data' => $components,
        ], 200);
    }

    /**
     * Find a single Component by its unique ID
     *
     * @throws ModelNotFoundException If Component is not found by ID
     */
    public function show(int $componentID): JsonResponse
    {
        $component = $this->componentRepository->getByID($componentID);

        return response()->json([
            'data' => $component,
        ], 200);
    }

    /**
     * Retrieve all Grades associated with a Component by the Component's ID
     *
     * @throws ModelNotFoundException If Component is not found by ID
     */
    public function grades(int $componentID): JsonResponse
    {
        $component = $this->componentRepository->getByID($componentID);
        $grades = $this->gradeRepository->getALLByComponent($component);

        return response()->json([
            'data' => $grades,
        ], 200);
    }

    /**
     * Find a single Graduate with it's ID associated with a Component
     *
     * @throws ModelNotFoundException If Component is not found by it's ID or Grade is not found by it's ID
     */
    public function showGrade(int $componentID, int $gradeID): JsonResponse
    {
        $this->componentRepository->getByID($componentID);
        $turbine = $this->gradeRepository->getByID($gradeID);

        return response()->json([
            'data' => $turbine,
        ], 200);
    }
}
