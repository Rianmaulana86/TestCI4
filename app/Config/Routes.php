<?php

use App\Controllers\Auth\AuthController;
use App\Controllers\Main\MainController;
use App\Controllers\Main\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', MainController::class);
$routes->get('/', [MainController::class, 'index'], ['filter' => 'auth']);

$routes->get('login', [AuthController::class, 'login']);
$routes->post('processLogin', [AuthController::class, 'processLogin']);

$routes->get('logout', [AuthController::class, 'logout'], ['filter' => 'auth']);
$routes->post('processRegister', [AuthController::class, 'processRegister'], ['filter' => 'auth']);
$routes->resource('user', ['controller' => 'Main\UserController'], ['filter' => 'auth']);
$routes->resource('pegawai', ['controller' => 'Main\PegawaiController'], ['filter' => 'auth']);