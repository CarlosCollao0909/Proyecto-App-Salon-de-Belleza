<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\CitaController;
use MVC\Router;

use Controllers\LoginController;

$router = new Router();


//login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

//logout
$router->get('/logout', [LoginController::class, 'logout']);
$router->post('/logout', [LoginController::class, 'logout']);

//recuperar password
$router->get('/forgot-password', [LoginController::class, 'forgotPassword']);
$router->post('/forgot-password', [LoginController::class, 'forgotPassword']);
$router->get('/reset-password', [LoginController::class, 'resetPassword']);
$router->post('/reset-password', [LoginController::class, 'resetPassword']);

//crear cuenta
$router->get('/create-account', [LoginController::class, 'createAccount']);
$router->post('/create-account', [LoginController::class, 'createAccount']);

//confirmar cuenta
$router->get('/confirm-account', [LoginController::class, 'confirmAccount']);
$router->get('/message', [LoginController::class, 'message']);

//area privada
$router->get('/appointment', [CitaController::class, 'index']);

//API de citas
$router->get('/api/services', [APIController::class, 'index']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();