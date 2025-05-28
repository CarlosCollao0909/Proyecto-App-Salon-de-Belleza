<?php

namespace Controllers;

use Model\Reporte;
use MVC\Router;

class DashboardController {
    public static function index(Router $router) {
        isStartedSession();
        isAuth();

        $ingresosMes = Reporte::obtenerIngresoTotalMes();
        $clientesRegistrados = Reporte::obtenerClientesRegistrados();
        $totalServicios = Reporte::obtenerTotalServicios();
        $citasFuturas = Reporte::obtenerCitasFuturas();
        
        $router->render('admin/dashboard/index', [
            'ingresosMes' => $ingresosMes,
            'clientesRegistrados' => $clientesRegistrados,
            'totalServicios' => $totalServicios,
            'citasFuturas' => $citasFuturas
        ]);
    }
}
