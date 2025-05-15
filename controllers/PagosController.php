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

    public static function update(Router $router) {
        isStartedSession();
        isAdmin();
        $id = $_GET['id'];
        if (!$id) {
            header('Location: /admin/servicios');
            exit;
        }

        $formaPago = FormaPago::find($id);
        $alertas = [];

        $router->render('admin/pagos/update', [
            'alertas' => $alertas,
            'formaPago' => $formaPago
        ]);
    }
}