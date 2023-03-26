<?php

use App\Http\Controllers\Api\V1\WorkLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/work/{id}/start', [WorkLogController::class, 'start']);
Route::get('/work/{id}/stop', [WorkLogController::class, 'stop']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
