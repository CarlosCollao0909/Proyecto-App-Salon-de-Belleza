<?php

namespace Controllers;

use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager as Image;
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

            //generar un nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            
            if ($_FILES['imagenComprobante']['tmp_name']) {
                $manager = new Image(GdDriver::class);
                $imagen = $manager->read($_FILES['imagenComprobante']['tmp_name'])->toPng(indexed: true);
                $comprobantePago->setImagenComprobante($nombreImagen, 60);
            }

            //comprobar si la carpeta existe
            if (!is_dir(CARPETA_IMAGENES_COMPROBANTES)) {
                mkdir(CARPETA_IMAGENES_COMPROBANTES);
            }
            
            //guardar la imagen en la carpeta
            $imagen->save(CARPETA_IMAGENES_COMPROBANTES . $nombreImagen);

            $comprobantePago->setCitaID($resultado['id']);
            $comprobantePago->setFechaSubida(date('Y-m-d H:i:s'));
            $resultadoComprobante = $comprobantePago->create();
        }
        
        $respuesta = [
            'resultado' => $resultado
        ];

        echo json_encode($respuesta); 
    }
}