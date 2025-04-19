<?php

namespace Controllers;

use MVC\Router;

class PagosController {
    public static function index(Router $router) {
        isStartedSession();
        isAuth();
        $router->render('admin/pagos/index');
    }
}