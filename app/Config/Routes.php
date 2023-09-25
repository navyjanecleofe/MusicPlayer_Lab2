<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/player', 'MainController::player');
$routes->post('/create', 'MainController::create');
$routes->get('/playlists/(:any)', 'MainController::/playlists/$1');
$routes->get('/play/(:any)', 'MainController::play/$1');
$routes->get('/search', 'MainController::search');
$routes->post('upload', 'MainController::upload'); // Assuming 'MainController' is your controller name

