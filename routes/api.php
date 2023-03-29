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

Route::middleware('authApi')->get('/work/start/{id}', [WorkLogController::class, 'start'])->name('startApi');
Route::middleware('authApi')->get('/work/stop/{id}', [WorkLogController::class, 'stop'])->name('stopApi');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
