<?php

namespace Model;

class FormaPago extends ActiveRecord {
    protected static $tabla = 'formaspagos';
    protected static $columnasDB = ['id', 'tipo', 'imagenQR'];

    public $id;
    public $tipo;
    public $imagenQR;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->tipo = $args['tipo'] ?? '';
        $this->imagenQR = $args['imagenQR'] ?? '';
    }

    public function validar() {
        if (!$this->imagenQR) {
            self::$alertas['error'][] = 'La imagen del código QR es obligatoria';
        }
        return self::$alertas;
    }

    public function setImagenQR($imagenQR) {
        $this->imagenQR = $imagenQR;
    }
}
