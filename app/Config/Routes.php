<?php

use CodeIgniter\Router\RouteCollection;


$routes->get('/', 'UserController::login');

$routes->get('registro', 'RegistroController::new');
$routes->post('registro', 'RegistroController::create');
$routes->get('verify_token/(:any)', 'UserController::verify/$1');
$routes->post('accountVerified', 'UserController::is_verified');
$routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);




// Rutas para el administrador
$routes->group(
    'admin',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->get('/', 'Admin\AdminController::index');

        $routes->get('usuarios/edit_password/(:num)', 'Admin\UsuarioController::editPassword/$1'); // Mostrar formulario para editar la contraseña
        $routes->post('usuarios/update_password/(:num)', 'Admin\UsuarioController::updatePassword/$1'); // Actualizar la contraseña del usuario
        $routes->resource('usuarios', ['controller' => 'Admin\UsuarioController']);

        $routes->get('asignaturas/(:num)/agregarAtributos', 'Admin\AsignaturaController::agregarAtributos/$1');
        $routes->get('asignaturas/(:num)/mostrarAtributos', 'Admin\AsignaturaController::mostrarAtributos/$1');
        $routes->post('asignaturas/guardarAtributos', 'Admin\AsignaturaController::guardarAtributos');
        $routes->resource('asignaturas', ['controller' => 'Admin\AsignaturaController']);

        $routes->resource('carreras', ['controller' => 'Admin\CarreraController']);


        $routes->get('competencias/(:num)/mostrarCalificaciones', 'Admin\CompetenciaController::mostrarCalificaciones/$1');
        $routes->delete('admin/competencias/(:num)', 'Admin\CompetenciaController::delete/$1');
        $routes->get('admin/competencias/(:num)/edit', 'Admin\CompetenciaController::edit/$1');
        $routes->post('competencias/agregarAtributo', 'Admin\CompetenciaController::createAtributos');
        $routes->post('competencias/guardarCalificacion', 'Admin\CompetenciaController::guardarCalificacion');
        $routes->resource('competencias', ['controller' => 'Admin\CompetenciaController']);

        $routes->get('grupos/(:num)/agregarAsignaturas', 'Admin\GrupoController::agregarAsignaturas/$1');
        $routes->get('grupos/(:num)/mostrarAsignaturas', 'Admin\GrupoController::mostrarAsignaturas/$1');
        $routes->post('grupos/guardarAsignaturas', 'Admin\GrupoController::guardarAsignaturas');
        $routes->resource('grupos', ['controller' => 'Admin\GrupoController']);

        $routes->post('matriculaciones/agregarEstudiantes', 'Admin\MatriculacionController::agregarEstudiantes');
        $routes->post('matriculaciones/deleteAlumno/(:num)', 'Admin\MatriculacionController::deleteAlumno/$1');
        $routes->post('matriculaciones/deleteGroup/(:num)', 'Admin\MatriculacionController::deleteGroup/$1');
        $routes->get('matriculaciones/edit/(:num)', 'Admin\MatriculacionController::edit/$1');
        $routes->post('matriculaciones/update/(:num)', 'Admin\MatriculacionController::update/$1');
        $routes->resource('matriculaciones', ['controller' => 'Admin\MatriculacionController']);


    }
);





// Rutas para el asesor
$routes->group(
    'asesor',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->get('/', 'Asesor\AsesorController::index');
        $routes->get('competencias', 'admin\CompetenciaController::index');
        $routes->get('grupos', 'admin\GrupoController::index');
        $routes->get('asignaturas', 'admin\AsignaturaController::index');
    }
);





// Rutas para el estudiante
$routes->group(
    'estudiante',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->get('/', 'estudiante\EstudianteController::index');

    }
);



$routes->get('logout', 'UserController::logout');