<?php

namespace Controllers;

use MVC\Router;

class ServiciosController {
    public static function index(Router $router) {
        isStartedSession();
        isAuth();
        $router->render('admin/servicios/index');
    }
}