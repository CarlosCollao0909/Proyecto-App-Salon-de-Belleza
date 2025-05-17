<?php

namespace Controllers;

use Model\FormaPago;
use MVC\Router;

class FormasPagosController {
    public static function index(Router $router) {
        isStartedSession();
        isAdmin();
        $formaPagos = FormaPago::all();

        $router->render('admin/formasPagos/index', [
            'formaPagos' => $formaPagos
        ]);
    }

    public static function update(Router $router) {
        isStartedSession();
        isAdmin();
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        validarRedireccionar($id, '/admin/formas_pagos');

        $formaPago = FormaPago::find($id);
        validarRedireccionar($formaPago, '/admin/formas_pagos');
        $alertas = [];

        $router->render('admin/formasPagos/update', [
            'alertas' => $alertas,
            'formaPago' => $formaPago
        ]);
    }
}