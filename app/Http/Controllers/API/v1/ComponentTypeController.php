<?php

namespace App\Http\Controllers\API\v1;

use App\Repositories\ComponentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ComponentTypeController extends Controller
{
    public function __construct(protected ComponentRepository $componentRepository)
    {
    }

    /**
     * Retrieve all Component Types e.g. Rotor, Hub
     */
    public function index(): JsonResponse
    {
        $componentTypes = $this->componentRepository->types();

        // This could be cached or defined within the code if it doesn't change often

        return response()->json([
            'data' => $componentTypes,
        ], 200);
    }

    /**
     * Find a Component Type by its Unique ID
     *
     * @throws ModelNotFoundException If Component Type is not found by ID
     */
    public function show(int $componentType): JsonResponse
    {
        $type = $this->componentRepository->getTypeByID($componentType);

        return response()->json([
            'data' => $type,
        ], 200);
    }
}
