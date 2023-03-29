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
        Route::get('/timer', [\App\Http\Controllers\PageController::class ,'timer'])->name('timer');
        Route::get('/upload', [\App\Http\Controllers\PageController::class ,'uploadWorker'])->name('upload');
        Route::post('/store', [\App\Http\Controllers\PageController::class ,'storeWorker'])->name('store');
    });
    Route::get('/', [\App\Http\Controllers\PageController::class ,'indexWorker'])->name('main');
    Route::match(['post', 'get'],'/{id}', [\App\Http\Controllers\PageController::class ,'showWorker'])->name('show');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
