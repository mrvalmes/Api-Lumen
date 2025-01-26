<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return "API Lumen corriendo...";
});

// Grupo para la API
$router->group(['prefix' => 'api'], function () use ($router) {

    // Rutas para el login (Ejemplo)
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@authenticate');
    //$router->post('login', 'AuthController@login');

    // Rutas para smartphones
    $router->get('smartphones', 'SmartphoneController@index');     // listar
    $router->post('smartphones', 'SmartphoneController@store');    // crear
    $router->get('smartphones/{id}', 'SmartphoneController@show'); // ver uno
    $router->put('smartphones/{id}', 'SmartphoneController@update');   // actualizar
    $router->delete('smartphones/{id}', 'SmartphoneController@destroy'); // eliminar

    // Ruta para facturas (facturación)
    $router->post('facturas', 'FacturaController@store');  // crear la factura
});

// Para que devuelva 200 en cualquier ruta OPTIONS
$router->options(
    '/{any:.*}',
    function () {
        return response('', 200);
    }
);