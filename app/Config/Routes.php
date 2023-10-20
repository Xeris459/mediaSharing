<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('login', 'AuthController::attemptLogin');

    $routes->get('dashboard', 'Home::dashboard');

    $routes->group('image', function ($routes) {
        $routes->get('', 'Images::index');
        $routes->get('tambah', 'Images::addPage');
        $routes->get('getData', 'Images::getData');
        $routes->post('store', 'Images::store');
        $routes->delete('(:num)', 'Images::destroy/$1');


        $routes->post("dropzone/upload", "Images::dropzoneStore");
        $routes->post("dropzone/remove", "Images::dropzoneRemove");
    });
});

service('auth')->routes($routes);
