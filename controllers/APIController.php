<?php

namespace Controllers;

use Model\Cita;
use Model\ComprobantePago;
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
        
        //verificar si existe una imagen en la global
        if (isset($_FILES['imagenComprobante'])) {
            $comprobantePago = new ComprobantePago;
            $comprobantePago->setCitaID($resultado['id']);
            $comprobantePago->setImagenComprobante('prueba.jpg');
            $comprobantePago->setFechaSubida(date('Y-m-d'));
            $resultadoComprobante = $comprobantePago->create();
            debug($resultadoComprobante);
        }
        
        /* $respuesta = [
            'resultado' => $resultado
        ];

        echo json_encode($respuesta); */
    }
}