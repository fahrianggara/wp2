<?php

use App\Controllers\Admin;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function() {
    return redirect()->route('login');
});

// Auth Routes
$routes->get('login', 'AuthController::login', ['as' => 'login', 'filter' => 'guest']);
$routes->post('login', 'AuthController::processLogin', ['as' => 'login', 'filter' => 'guest']);
$routes->delete('logout', 'AuthController::logout', ['as' => 'logout', 'filter' => 'auth']);

// Admin Routes
$routes->group('admin', ['filter' => ['auth', 'role_admin'], 'namespace' => Admin::class], function ($routes) {
    $routes->get('dash', 'DashController::index', ['as' => 'admin.dash']);

    // Admin > Siswa Routes
    $routes->group('siswa', function ($routes) {
        $routes->get('/', 'SiswaController::index', ['as' => 'admin.siswa']);
        $routes->get('create', 'SiswaController::create', ['as' => 'admin.siswa.create']);
        $routes->post('store', 'SiswaController::store', ['as' => 'admin.siswa.store']);
    });
});