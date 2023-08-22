<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    /**
     * Displays a health signal for blue/green or whatever type of deployment is desired
     */
    public function index()
    {
        return response()->json([
            'status' => 'OK',
            'timestamp' => now(),
        ], 200);
    }
}
