<?php

namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index(Router $router) {
        isStartedSession();
        isAuth();
        $id = $_SESSION['id'];
        $nombre = $_SESSION['nombre'];
        
        $router->render('cita/index', [
            'nombre' => $nombre,
            'id' => $id
        ]);
    }
}