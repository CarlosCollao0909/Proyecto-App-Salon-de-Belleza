<?php

namespace Controllers;

use Model\Cita;
use MVC\Router;

class CitasController {
    public static function index(Router $router) {
        isStartedSession();
        isAdmin();
        $router->render('admin/citas/index');
    }

    public static function update() {
        isStartedSession();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $id = filter_var($id, FILTER_VALIDATE_INT);
            validarRedireccionar($id, '/admin/citas');

            $cita = Cita::find($id);
            validarRedireccionar($cita, '/admin/citas');

            $cita->estado = 'finalizada';
            $cita->update();
            header('Location: /admin/citas?cita_actualizada=1');

        }
    }
}