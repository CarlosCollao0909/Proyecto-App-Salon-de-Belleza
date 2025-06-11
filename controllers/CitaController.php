<?php

namespace Controllers;

use Model\Cita;
use Model\FormaPago;
use Model\Reporte;
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

    public static function showHistorial(Router $router) {
        isStartedSession();
        isAuth();
        $id = $_SESSION['id'] ?? null;
        $id = filter_var($id, FILTER_VALIDATE_INT);
        validarRedireccionar($id, '/');
        $citas = Reporte::obtenerHistorialPorCliente($id);
        validarRedireccionar($citas, '/historial');

        $nombre = $_SESSION['nombre'];
        
        $router->render('cita/historial', [
            'citas' => $citas,
            'nombre' => $nombre
        ]);
    }

    public static function update() {
        isStartedSession();
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $id = filter_var($id, FILTER_VALIDATE_INT);
            validarRedireccionar($id, '/');

            $cita = Cita::find($id);
            validarRedireccionar($cita, '/');

            $cita->estado = 'cancelada';
            $cita->update();
            header('Location: /historial');
        }
    }
}