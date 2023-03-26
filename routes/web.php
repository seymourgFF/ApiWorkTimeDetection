<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return  redirect()->route('main');//view('welcome');
});

Route::group(['prefix' => 'workers'], function () {

    Route::group(['middleware'=>['auth', 'verified']], function () {
        Route::get('/upload', [\App\Http\Controllers\MainController::class ,'upload'])->name('upload');
    });
    Route::get('/', [\App\Http\Controllers\MainController::class ,'main'])->name('main');
    Route::get('/{id}', [\App\Http\Controllers\MainController::class ,'show'])->name('show');
    Route::post('/store', [\App\Http\Controllers\MainController::class ,'store'])->name('store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
