<?php

namespace Controllers;

use Model\Cita;
use Model\Horario;
use Model\Servicio;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function showHorarios() {
        $horarios = Horario::all();
        echo json_encode($horarios);
    }

    public static function create() {
        // Almacenar la cita y devolver el id
        $cita = new Cita($_POST);
        $resultado = $cita->create();

        $respuesta = [
            'resultado' => $resultado
        ];

        echo json_encode($respuesta);
    }
}