<?php

use App\Controllers\MovieController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/movies', [MovieController::class, 'index']);
$routes->post('/movies', [MovieController::class, 'create']);
$routes->put('/movies/(:segment)', [MovieController::class, 'update']);
$routes->delete('/movies/(:segment)', [MovieController::class, 'delete']);
