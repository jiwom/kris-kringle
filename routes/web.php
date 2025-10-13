<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\IndexController;

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

Route::get('reset-seed', function () {
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed', ['--class' => 'UsersTableSeeder']);
});

Route::get('/results', [IndexController::class, 'viewResults']);
Route::get('/{cluster}', [IndexController::class, 'index']);
Route::post('/{cluster}', [IndexController::class, 'store']);
Route::get('reset/{cluster}', [IndexController::class, 'reset']);
