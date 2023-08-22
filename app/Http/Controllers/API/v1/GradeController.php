<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Repositories\GradeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class GradeController extends Controller
{
    public function __construct(protected GradeRepository $gradeRepository)
    {
    }

    /**
     * Retrieve all the Grades
     */
    public function index(): JsonResponse
    {
        $grades = $this->gradeRepository->getALL();

        return response()->json([
            'data' => $grades,
        ], 200);
    }

    /**
     * Find a single Grade by its ID
     *
     * @throws ModelNotFoundException If Grade is not found by ID
     */
    public function show(int $gradeID): JsonResponse
    {
        $grade = $this->gradeRepository->getByID($gradeID);

        return response()->json([
            'data' => $grade,
        ], 200);
    }
}
