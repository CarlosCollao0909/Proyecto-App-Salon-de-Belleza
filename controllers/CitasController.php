<?php

namespace Controllers;

use MVC\Router;

class CitasController {
    public static function index(Router $router) {
        isStartedSession();
        isAuth();
        $router->render('admin/citas/index');
    }
}