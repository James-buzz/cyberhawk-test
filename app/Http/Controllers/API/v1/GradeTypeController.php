<?php

namespace App\Http\Controllers\API\v1;

use App\Repositories\GradeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class GradeTypeController extends Controller
{
    public function __construct(protected GradeRepository $gradeRepository)
    {
    }

    /**
     * Retrieve all Grade Types e.g. no wear,
     */
    public function index(): JsonResponse
    {
        $gradeTypes = $this->gradeRepository->types();

        return response()->json([
            'data' => $gradeTypes,
        ], 200);
    }

    /**
     * Find a single Grade Type by its ID.
     *
     * @throws ModelNotFoundException If Grade Type is not found by ID
     */
    public function show(int $gradeType): JsonResponse
    {
        $type = $this->gradeRepository->getTypeByID($gradeType);

        return response()->json([
            'data' => $type,
        ], 200);
    }
}
