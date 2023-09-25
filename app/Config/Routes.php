<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/main', 'MainController::main');
$routes->post('/createPlaylist', 'MainController::createPlaylist');
$routes->post('/addsong', 'MainController::addsong');