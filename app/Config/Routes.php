<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/client/login', 'ClientAuthController::login');
$routes->post('/client/login/authenticate', 'ClientAuthController::authenticate');
$routes->get('/client/logout', 'ClientAuthController::logout');

$routes->get('/client/dashboard', 'ClientDashboardController::index');

$routes->get('/client/depot', 'DepotController::index');
$routes->post('/client/depot/store', 'DepotController::store');

$routes->get('/client/retrait', 'RetraitController::index');
$routes->post('/client/retrait/store', 'RetraitController::store');

$routes->get('/client/transfert', 'TransfertController::index');
$routes->post('/client/transfert/store', 'TransfertController::store');

$routes->get('/client/historique', 'HistoriqueController::index');
