<?php

namespace Controllers;

use MVC\Router;

class ClientesController {
    public static function index(Router $router) {
        isStartedSession();
        isAuth();
        $router->render('admin/clientes/index');
    }
}