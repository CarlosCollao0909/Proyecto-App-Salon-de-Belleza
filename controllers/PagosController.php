<?php

namespace Controllers;

use Model\FormaPago;
use MVC\Router;

class PagosController {
    public static function index(Router $router) {
        isStartedSession();
        isAdmin();
        $formaPagos = FormaPago::all();

        $router->render('admin/pagos/index', [
            'formaPagos' => $formaPagos
        ]);
    }
}