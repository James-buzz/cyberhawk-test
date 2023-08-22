<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Repositories\GradeRepository;
use App\Repositories\InspectionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class InspectionController extends Controller
{
    public function __construct(protected InspectionRepository $inspectionRepository, protected GradeRepository $gradeRepository)
    {
    }

    /**
     * Retrieve all the Inspections
     */
    public function index(): JsonResponse
    {
        $inspections = $this->inspectionRepository->getALL();

        return response()->json([
            'data' => $inspections,
        ], 200);
    }

    /**
     * Find a single Inspection by its Unique ID
     *
     * @throws ModelNotFoundException If Inspection is not found by ID
     */
    public function show(int $inspectionID): JsonResponse
    {
        $inspection = $this->inspectionRepository->getByID($inspectionID);

        return response()->json([
            'data' => $inspection,
        ], 200);
    }

    /**
     * Retrieve all Grades that are associated with a given Inspection
     *
     * @throws ModelNotFoundException If Inspection is not found by ID
     */
    public function grades(int $inspectionID): JsonResponse
    {
        $inspection = $this->inspectionRepository->getByID($inspectionID);
        $grades = $this->gradeRepository->getALLByInspection($inspection);

        return response()->json([
            'data' => $grades,
        ], 200);
    }

    /**
     * Find a single Grade by its Unique ID and by Inspection ID
     *
     * @throws ModelNotFoundException If Inspection is not found by ID
     */
    public function showGrade(int $inspectionID, int $gradeID): JsonResponse
    {
        $this->inspectionRepository->getByID($inspectionID);
        $turbine = $this->gradeRepository->getByID($gradeID);

        return response()->json([
            'data' => $turbine,
        ], 200);
    }
}
