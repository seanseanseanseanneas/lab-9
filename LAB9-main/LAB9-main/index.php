<?php

require "vendor/autoload.php";
require "init.php";

// Database connection object (from init.php (DatabaseConnection))
global $conn;

try {

    // Create Router instance
    $router = new \Bramus\Router\Router();

    // Define routes
    $router->get('/', '\App\Controllers\HomeController@index');
    $router->get('/suppliers', '\App\Controllers\SupplierController@list');
    $router->get('/customers', '\App\Controllers\CustomerController@list');
    $router->get('/customers/{id}', '\App\Controllers\CustomerController@single');
    $router->get('/suppliers/{id}', '\App\Controllers\SupplierController@single');
    $router->post('/customers/{id}', '\App\Controllers\CustomerController@update');
    $router->post('/suppliers/{id}', '\App\Controllers\SupplierController@update');
    // Run it!
    $router->run();

} catch (Exception $e) {

    echo json_encode([
        'error' => $e->getMessage()
    ]);

}
