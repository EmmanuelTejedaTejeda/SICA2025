<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');



$routes->resource('admin/asignaturas', ['controller' => 'Admin\AsignaturaController']);
$routes->resource('admin/carreras', ['controller' => 'Admin\CarreraController']);


