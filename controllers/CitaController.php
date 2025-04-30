<?php

namespace Controllers;

use Model\FormaPago;
use MVC\Router;

class CitaController {
    public static function index(Router $router) {
        isStartedSession();
        isAuth();
        $id = $_SESSION['id'];
        $nombre = $_SESSION['nombre'];
        $formasPago = FormaPago::all();
        
        $router->render('cita/index', [
            'nombre' => $nombre,
            'id' => $id,
            'formasPago' => $formasPago
        ]);
    }
}