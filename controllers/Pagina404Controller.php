<?php

namespace Controllers;

use MVC\Router;

class Pagina404Controller {
    public static function index(Router $router) {
        $router->render('error/404');
    }
}