<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/{cluster}', 'IndexController@index' );
Route::post('/{cluster}', 'IndexController@store' );
Route::get('reset-seed', function(){
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed',['--class' => 'UsersTableSeeder']);
    return redirect('/');
} );
Route::get('reset/{cluster}', 'IndexController@reset');
