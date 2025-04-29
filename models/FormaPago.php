<?php

namespace Model;

class FormaPago extends ActiveRecord {
    protected static $tabla = 'formas_pago';
    protected static $columnasDB = ['id', 'tipo', 'imagenQR'];

    public $id;
    public $tipo;
    public $imagenQR;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->tipo = $args['tipo'] ?? '';
        $this->imagenQR = $args['imagenQR'] ?? 'N/A';
    }
}