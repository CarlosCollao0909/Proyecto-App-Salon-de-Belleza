<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\CitasController;
use Controllers\ClientesController;
use Controllers\DashboardController;
use Controllers\HorariosController;
use MVC\Router;

use Controllers\LoginController;
use Controllers\PagosController;
use Controllers\ServiciosController;

$router = new Router();


//login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

//logout
$router->get('/logout', [LoginController::class, 'logout']);

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
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/historial', [CitasController::class, 'showHistorial']);

//API de citas
$router->get('/api/servicios', [APIController::class, 'index']);
$router->get('/api/horarios', [APIController::class, 'showHorarios']);
$router->post('/api/citas', [APIController::class, 'create']);

//area de administracion
$router->get('/admin/dashboard', [DashboardController::class, 'index']);
$router->get('/admin/citas', [CitasController::class, 'index']);
$router->get('/admin/clientes', [ClientesController::class, 'index']);
$router->get('/admin/horarios', [HorariosController::class, 'index']);
$router->get('/admin/pagos', [PagosController::class, 'index']);

$router->get('/admin/servicios', [ServiciosController::class, 'index']);
$router->get('/admin/servicios/crear', [ServiciosController::class, 'create']);
$router->post('/admin/servicios/crear', [ServiciosController::class, 'create']);
$router->get('/admin/servicios/editar', [ServiciosController::class, 'update']);
$router->post('/admin/servicios/editar', [ServiciosController::class, 'update']);
$router->post('/admin/servicios/eliminar', [ServiciosController::class, 'delete']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();