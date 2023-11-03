<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function() {
    return redirect()->route('login');
});

// Auth routes
$routes->match(['get', 'post'], 'login', 'AuthController::login', ['as' => 'login']);
