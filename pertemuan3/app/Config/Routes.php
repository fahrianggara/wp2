<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('web', 'WebController::index'); // <-- Menampilkan halaman utama (web)