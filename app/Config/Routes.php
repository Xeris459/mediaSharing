<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('search', 'Home::search');
$routes->get('load_more', 'Home::loadMore');
$routes->group('', ['filter' => "session" ], function ($routes) {
    $routes->get('download/(:num)', 'Home::download/$1');
    $routes->get('downloadMultiple', 'Home::downloadBatch');
});

$routes->post('login', 'AuthController::attemptLogin');
$routes->group('', ['namespace' => 'App\Controllers', 'filter' => "session" ], function ($routes) {

    $routes->get('dashboard', 'Home::dashboard');

    $routes->group('image', function ($routes) {
        $routes->get('', 'ImagesController::index');
        $routes->get('tambah', 'ImagesController::addPage');
        $routes->get('getData', 'ImagesController::getData');
        $routes->get('edit/(:num)', 'ImagesController::editPage/$1');
        $routes->post('store', 'ImagesController::store');
        $routes->post('update', 'ImagesController::update');
        $routes->delete('(:num)', 'ImagesController::destroy/$1');


        $routes->post("dropzone/upload", "ImagesController::dropzoneStore");
        $routes->post("dropzone/remove", "ImagesController::dropzoneRemove");
    });

    $routes->group('category', function ($routes) {
        $routes->get('', 'CategoryController::index');
        $routes->get('tambah', 'CategoryController::addPage');
        $routes->get('getData', 'CategoryController::getData');
        $routes->get('edit/(:num)', 'CategoryController::editPage/$1');
        $routes->post('store', 'CategoryController::store');
        $routes->post('update', 'CategoryController::update');
        $routes->delete('(:num)', 'CategoryController::destroy/$1');
    });

    $routes->group('users', ['filter' => "group:admin,superadmin"], function ($routes) {
        $routes->get('', 'UserController::index');
        $routes->get('tambah', 'UserController::addPage');
        $routes->get('getData', 'UserController::getData');
        $routes->get('edit/(:num)', 'UserController::editPage/$1');
        $routes->post('store', 'UserController::store');
        $routes->post('update', 'UserController::update');
        $routes->delete('(:num)', 'UserController::destroy/$1');
    });

    $routes->group('approvement', ['filter' => "group:admin,superadmin"], function ($routes) {
        $routes->get('', 'ApprovementController::index');
        $routes->get('getData', 'ApprovementController::getData');
        $routes->put('accept/(:num)', 'ApprovementController::accept/$1');
        $routes->put('reject/(:num)', 'ApprovementController::reject/$1');
    });

    $routes->group('profile', function ($routes) {
        $routes->get('', 'ProfileController::index');
        $routes->post('update', 'ProfileController::update');
    });
});

service('auth')->routes($routes);
