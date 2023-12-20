<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('admin/carreras', 'Admin\CarreraController::index');
$routes->get('admin/carreras/new', 'Admin\CarreraController::new');
$routes->post('admin/carreras', 'Admin\CarreraController::store');
$routes->get('admin/carreras/edit/(:num)', 'Admin\CarreraController::new/$1');
// $routes->update('admin/carreras', 'Admin\CarreraController::update');

$routes->resource('admin/asignaturas', ['controller' => 'Admin\AsignaturaController']);


