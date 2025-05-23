<?php

namespace Controllers;

use Model\Horario;
use MVC\Router;

class HorariosController {
    public static function index(Router $router) {
        isStartedSession();
        isAdmin();
        $horarios = Horario::all();
        
        $router->render('admin/horarios/index', [
            'horarios' => $horarios
        ]);
    }
}