<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    // Jika user mengakses halaman utama (localhost:8080/)-
    // -maka akan diarahkan ke halaman web (localhost:8080/web)
    return redirect()->to('/web');
});

$routes->get('web', 'WebController::index'); // <-- Menampilkan halaman utama (web)
$routes->get('about', 'WebController::about'); // <-- Menampilkan halaman about (web/about)