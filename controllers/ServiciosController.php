<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServiciosController {
    public static function index(Router $router) {
        isStartedSession();
        isAdmin();
        $servicios = Servicio::whereAll('estado', '1');
        $router->render('admin/servicios/index', [
            'servicios' => $servicios
        ]);
    }

    public static function create(Router $router) {
        isStartedSession();
        isAdmin();
        $alertas = [];
        $servicio = new Servicio;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if (empty($alertas)) {
                $resultado = $servicio->create();

                if ($resultado) {
                    header('Location: /admin/servicios?servicio_creado=1');
                    exit;
                }
            }
        }

        $router->render('admin/servicios/create', [
            'alertas' => $alertas,
            'servicio' => $servicio
        ]);
    }

    public static function update(Router $router) {
        isStartedSession();
        isAdmin();

        $id = $_GET['id'] ?? '';
        $id = filter_var($id, FILTER_VALIDATE_INT);
        validarRedireccionar($id, '/admin/servicios');

        $servicio = Servicio::find($id);
        validarRedireccionar($servicio, '/admin/servicios');
        
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if (empty($alertas)) {
                $resultado = $servicio->update();
                if ($resultado) {
                    header('Location: /admin/servicios?servicio_actualizado=1');
                    exit;
                }
            }
        }

        $router->render('admin/servicios/update', [
            'alertas' => $alertas,
            'servicio' => $servicio
        ]);
    }

    public static function delete() {
        isStartedSession();
        isAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->estado = '0'; // Cambiar el estado a inactivo
            $resultado = $servicio->update();
            if ($resultado) {
                header('Location: /admin/servicios?servicio_eliminado=1');
                exit;
            }
        }
    }
}
