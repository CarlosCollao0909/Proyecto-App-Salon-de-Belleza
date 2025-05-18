<?php

namespace Controllers;

use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager as Image;

use Model\FormaPago;
use MVC\Router;

class FormasPagosController {
    public static function index(Router $router) {
        isStartedSession();
        isAdmin();
        $formaPagos = FormaPago::all();

        $router->render('admin/formasPagos/index', [
            'formaPagos' => $formaPagos
        ]);
    }

    public static function update(Router $router) {
        isStartedSession();
        isAdmin();
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        validarRedireccionar($id, '/admin/formas_pagos');

        $formaPago = FormaPago::find($id);
        validarRedireccionar($formaPago, '/admin/formas_pagos');
        $alertas = [];

        

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formaPago->sincronizar($_POST);
            $alertas = $formaPago->validar();

            if(empty($alertas)) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".png";

                if($_FILES['imagenQR']['tmp_name']) {
                    $manager = new Image(GdDriver::class);
                    $imagen = $manager->read($_FILES['imagenQR']['tmp_name'])->toPng(indexed: true);
                    $imagen->save(CARPETA_IMAGENES_QR . $nombreImagen, 65);
                    $formaPago->setImagenQR($nombreImagen);
                }

                $resultado = $formaPago->update();

                if($resultado) {
                    header('Location: /admin/formas_pagos?forma_pago_actualizada=1');
                }

            }
        }

        $router->render('admin/formasPagos/update', [
            'alertas' => $alertas,
            'formaPago' => $formaPago
        ]);
    }
}