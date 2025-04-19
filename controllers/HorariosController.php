<?php

namespace Controllers;

use MVC\Router;

class HorariosController {
    public static function index(Router $router) {
        isStartedSession();
        isAuth();
        $router->render('admin/horarios/index');
    }
}