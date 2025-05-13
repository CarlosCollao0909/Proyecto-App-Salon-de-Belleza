<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class ClientesController {
    public static function index(Router $router) {
        isStartedSession();
        isAuth();
        $clientes = Usuario::whereAll('admin', '0');
        
        $router->render('admin/clientes/index', [
            'clientes' => $clientes
        ]);
    }
}