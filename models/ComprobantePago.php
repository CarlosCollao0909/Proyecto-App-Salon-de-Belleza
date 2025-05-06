<?php

namespace Model;

class ComprobantePago extends ActiveRecord {
    //db
    protected static $tabla = 'comprobantePagos';
    protected static $columnasDB = ['id', 'imagenComprobante', 'fechaSubida', 'citaID'];

    public $id;
    public $imagenComprobante;
    public $fechaSubida;
    public $citaID;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->imagenComprobante = $args['imagenComprobante'] ?? '';
        $this->fechaSubida = $args['fechaSubida'] ?? '';
        $this->citaID = $args['citaID'] ?? '';
    }
}