<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.

$router->get('/', function () use ($router) {
    return $router->app->version();
});
|
*/



$router->post('/auth/login', [
    'uses' => 'AuthController@authenticate'
]);

$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router){
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    }
);

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('smartphones', 'SmartphonesController@index');
    $router->get('smartphones/{id}', 'SmartphonesController@show');
    $router->post('smartphones', 'SmartphonesController@store');
    $router->put('smartphones/{id}', 'SmartphonesController@update');
    $router->delete('smartphones/{id}', 'SmartphonesController@destroy');
});