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
        $routes->post('destroy', 'SiswaController::destroy', ['as' => 'admin.siswa.destroy']);
        $routes->get('edit/(:any)', 'SiswaController::edit/$1', ['as' => 'admin.siswa.edit']);
        $routes->post('update', 'SiswaController::update', ['as' => 'admin.siswa.update']);
    });

    // Admin > Guru Routes
    $routes->group('guru', function ($routes) {
        $routes->get('/', 'GuruController::index', ['as' => 'admin.guru']);
        $routes->get('create', 'GuruController::create', ['as' => 'admin.guru.create']);
        $routes->post('store', 'GuruController::store', ['as' => 'admin.guru.store']);
        $routes->post('destroy', 'GuruController::destroy', ['as' => 'admin.guru.destroy']);
        $routes->get('edit/(:any)', 'GuruController::edit/$1', ['as' => 'admin.guru.edit']);
        $routes->post('update', 'GuruController::update', ['as' => 'admin.guru.update']);
    });
});