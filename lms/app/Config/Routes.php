<?php

use App\Controllers\Admin;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function() {
    return redirect()->route('login');
});

// Auth routes
$routes->get('login', 'AuthController::login', ['as' => 'login', 'filter' => 'guest']);
$routes->post('login', 'AuthController::processLogin', ['as' => 'login', 'filter' => 'guest']);
$routes->delete('logout', 'AuthController::logout', ['as' => 'logout', 'filter' => 'auth']);

// Admin Routes
$routes->group('admin', ['filter' => ['auth', 'role_admin'], 'namespace' => Admin::class], function ($routes) {
    $routes->get('dash', 'DashController::index', ['as' => 'admin.dash']);
});