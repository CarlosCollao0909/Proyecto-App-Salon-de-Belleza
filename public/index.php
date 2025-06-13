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
use Controllers\FormasPagosController;
use Controllers\Pagina404Controller;
use Controllers\ReportesAPIController;
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
$router->get('/historial', [CitaController::class, 'showHistorial']);
$router->post('/cita/cancelar', [CitaController::class, 'update']);

//API
$router->get('/api/servicios', [APIController::class, 'index']);
$router->get('/api/horarios', [APIController::class, 'showHorarios']);
$router->post('/api/horarios/estado', [APIController::class, 'cambiarEstadoHorarios']);
$router->post('/api/citas', [APIController::class, 'create']);
$router->get('/api/citas_admin', [APIController::class, 'getCitas']);

$router->get('/api/reportes/ingresos_mensuales', [ReportesAPIController::class, 'ingresosPorMes']);
$router->get('/api/reportes/ingresos_diarios', [ReportesAPIController::class, 'ingresosPorDia']);
$router->get('/api/reportes/servicios_solicitados', [ReportesAPIController::class, 'serviciosSolicitados']);
$router->get('/api/reportes/clientes_frecuentes', [ReportesAPIController::class, 'clientesFrecuentes']);
$router->get('/api/reportes/horarios_demandados', [ReportesAPIController::class, 'horariosDemandados']);

//area de administracion
$router->get('/admin/dashboard', [DashboardController::class, 'index']);
$router->get('/admin/citas', [CitasController::class, 'index']);
$router->post('/admin/citas/editar', [CitasController::class, 'update']);
$router->get('/admin/clientes', [ClientesController::class, 'index']);
$router->get('/admin/horarios', [HorariosController::class, 'index']);
$router->get('/admin/formas_pagos', [FormasPagosController::class, 'index']);
$router->get('/admin/formas_pagos/actualizar_qr', [FormasPagosController::class, 'update']);
$router->post('/admin/formas_pagos/actualizar_qr', [FormasPagosController::class, 'update']);

$router->get('/admin/servicios', [ServiciosController::class, 'index']);
$router->get('/admin/servicios/crear', [ServiciosController::class, 'create']);
$router->post('/admin/servicios/crear', [ServiciosController::class, 'create']);
$router->get('/admin/servicios/editar', [ServiciosController::class, 'update']);
$router->post('/admin/servicios/editar', [ServiciosController::class, 'update']);
$router->post('/admin/servicios/eliminar', [ServiciosController::class, 'delete']);

//error 404
$router->get('/error/404', [Pagina404Controller::class, 'index']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();