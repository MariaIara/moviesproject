<?php

use App\Controllers\MovieController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/movies', [MovieController::class, 'index']);
$routes->get('/movies/(:segment)', [MovieController::class, 'show']);
$routes->get('/movies/rating/(:segment)', [MovieController::class, 'moviesByRating']);

$routes->post('/movies', [MovieController::class, 'create']);
$routes->put('/movies/(:segment)', [MovieController::class, 'update']);
$routes->delete('/movies/(:segment)', [MovieController::class, 'delete']);

$routes->patch('/movies/(:segment)', [MovieController::class, 'rating']);
