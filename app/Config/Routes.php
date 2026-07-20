<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ClientAuthController::login');

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

$routes->get('/client/transfert-multiple', 'TransfertMultipleController::index');
$routes->post('/client/transfert-multiple/store', 'TransfertMultipleController::store');

$routes->get('/client/historique', 'HistoriqueController::index');

$routes->get('/operateur/login', 'Operateur\AuthController::index');
$routes->post('/operateur/login', 'Operateur\AuthController::login');
$routes->get('/operateur/logout', 'Operateur\AuthController::logout');

$routes->get('/operateur/dashboard', 'Operateur\DashboardController::index');

$routes->get('/operateur/prefixes', 'Operateur\PrefixeController::index');
$routes->get('/operateur/prefixes/create', 'Operateur\PrefixeController::create');
$routes->post('/operateur/prefixes/store', 'Operateur\PrefixeController::store');
$routes->get('/operateur/prefixes/toggle/(:num)', 'Operateur\PrefixeController::toggle/$1');
$routes->get('/operateur/prefixes/delete/(:num)', 'Operateur\PrefixeController::delete/$1');

$routes->get('/operateur/types_operations', 'Operateur\TypeOperationController::index');
$routes->get('/operateur/types_operations/create', 'Operateur\TypeOperationController::create');
$routes->post('/operateur/types_operations/store', 'Operateur\TypeOperationController::store');
$routes->get('/operateur/types_operations/toggle/(:num)', 'Operateur\TypeOperationController::toggle/$1');
$routes->get('/operateur/types_operations/delete/(:num)', 'Operateur\TypeOperationController::delete/$1');

$routes->get('/operateur/baremes_frais', 'Operateur\BaremeFraisController::index');
$routes->get('/operateur/baremes_frais/create', 'Operateur\BaremeFraisController::create');
$routes->post('/operateur/baremes_frais/store', 'Operateur\BaremeFraisController::store');
$routes->get('/operateur/baremes_frais/edit/(:num)', 'Operateur\BaremeFraisController::edit/$1');
$routes->post('/operateur/baremes_frais/update/(:num)', 'Operateur\BaremeFraisController::update/$1');
$routes->get('/operateur/baremes_frais/delete/(:num)', 'Operateur\BaremeFraisController::delete/$1');