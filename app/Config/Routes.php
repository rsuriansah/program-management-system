<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Akaun Pengguna
$routes->get('profile', 'PenggunaController::index');
$routes->post('profile', 'PenggunaController::editAkaun');

// Permohonan
$routes->get('application', 'PermohonanController::index');
$routes->get('application/add', 'PermohonanController::formAddPermohonan');
$routes->post('application/add', 'PermohonanController::addPermohonan');
$routes->match(['GET', 'POST'], 'application/draft', 'PermohonanController::saveDraft');
$routes->get('application/detail/(:num)', 'PermohonanController::detail/$1');
$routes->post('application/detail/(:num)', 'PermohonanController::updateStatus/$1', ['filter' => 'group:superadmin,admin']);
$routes->post('application/detail/edit/(:num)', 'PermohonanController::update/$1');
$routes->delete('application/delete/(:any)', 'PermohonanController::delete/$1');

// Laporan
$routes->get('report', 'LaporanController::index');
$routes->post('report', 'LaporanController::uploadLaporan');

service('auth')->routes($routes);