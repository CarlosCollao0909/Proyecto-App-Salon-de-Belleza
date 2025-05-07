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
        $fecha = $_GET['fecha'] ?? '';
        //validar la fecha
        if (!$fecha) {
            echo json_encode(['error' => 'Seleccione una fecha']);
            return;
        }
        $citas = Cita::pluckColumn('horarioID', 'fecha', $fecha);
        $horarios = Horario::all();
        
        // filtrar los horarios que no esten ocupados
        $horariosDisponibles = [];
        foreach ($horarios as $horario) {
            if (!in_array($horario->id, $citas)) {
                $horariosDisponibles[] = $horario;
            }
        }
        echo json_encode($horariosDisponibles);
    }

    public static function create() {
        // Almacenar la cita y devolver el id
        $cita = new Cita($_POST);
        $resultado = $cita->create();
        debug($resultado['id']);
        /* $respuesta = [
            'resultado' => $resultado
        ];

        echo json_encode($respuesta); */
    }
}