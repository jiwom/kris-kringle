<?php
$router = app('router');

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
$router->get('reset-seed', function(){
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed',['--class' => 'UsersTableSeeder']);
    dump('done!');
} );
$router->get('/results', 'IndexController@viewResults' );
$router->get('/{cluster}', 'IndexController@index' );
$router->post('/{cluster}', 'IndexController@store' );
$router->get('reset/{cluster}', 'IndexController@reset');

