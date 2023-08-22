<?php

use App\Http\Controllers\API\v1\ComponentController;
use App\Http\Controllers\API\v1\ComponentTypeController;
use App\Http\Controllers\API\v1\FarmController;
use App\Http\Controllers\API\v1\GradeController;
use App\Http\Controllers\API\v1\GradeTypeController;
use App\Http\Controllers\API\v1\InspectionController;
use App\Http\Controllers\API\v1\StatusController;
use App\Http\Controllers\API\v1\TurbineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', [StatusController::class, 'index'])->name('status');

Route::get('/component-types', [ComponentTypeController::class, 'index'])->name('components.types');
Route::get('/component-types/{componentType}', [ComponentTypeController::class, 'show'])->name('components.types.show');
Route::get('/grade-types', [GradeTypeController::class, 'index'])->name('grades.types');
Route::get('/grade-types/{gradeType}', [GradeTypeController::class, 'show'])->name('grades.types.show');

Route::get('/farms', [FarmController::class, 'index'])->name('farms');
Route::get('/farms/{farmID}', [FarmController::class, 'show'])->name('farms.show');
Route::get('/farms/{farmID}/turbines', [FarmController::class, 'turbines'])->name('farms.turbines');
Route::get('/farms/{farmID}/turbines/{turbineID}', [FarmController::class, 'showTurbine'])->name('farms.turbines.show');

Route::get('/turbines', [TurbineController::class, 'index'])->name('turbines');
Route::get('/turbines/{turbineID}', [TurbineController::class, 'show'])->name('turbines.show');
Route::get('/turbines/{turbineID}/components', [TurbineController::class, 'components'])->name('turbines.components');
Route::get('/turbines/{turbineID}/components/{componentID}', [TurbineController::class, 'showComponent'])->name('turbines.components.show');
Route::get('/turbines/{turbineID}/inspections', [TurbineController::class, 'inspections'])->name('turbines.inspections');
Route::get('/turbines/{turbineID}/inspections/{inspectionID}', [TurbineController::class, 'showInspection'])->name('turbines.inspections.show');

Route::get('/inspections', [InspectionController::class, 'index'])->name('inspections');
Route::get('/inspections/{inspectionID}', [InspectionController::class, 'show'])->name('inspections.show');
Route::get('/inspections/{inspectionID}/grades', [InspectionController::class, 'grades'])->name('inspections.grades');
Route::get('/inspections/{inspectionID}/grades/{gradeID}', [InspectionController::class, 'showGrade'])->name('inspections.grades.show');

Route::get('/components', [ComponentController::class, 'index'])->name('components');
Route::get('/components/{componentID}', [ComponentController::class, 'show'])->name('components.show');
Route::get('/components/{componentID}/grades', [ComponentController::class, 'grades'])->name('components.grades');
Route::get('/components/{componentID}/grades/{gradeID}', [ComponentController::class, 'showGrade'])->name('components.grades.show');

Route::get('/grades', [GradeController::class, 'index'])->name('grades');
Route::get('/grades/{gradeID}', [GradeController::class, 'show'])->name('grades.show');

Route::fallback(function () {
    return response()->json(['code' => 404, 'message' => 'Could not find API resource'], 404);
});
