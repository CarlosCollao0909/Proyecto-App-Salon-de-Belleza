<?php

namespace Controllers;

use MVC\Router;

class CitasController {
    public static function index(Router $router) {
        isStartedSession();
        isAdmin();
        $router->render('admin/citas/index');
    }

    public static function showHistorial(Router $router) {
        isStartedSession();
        isAuth();
        $router->render('cita/historial');
    }
}