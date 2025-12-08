<?php

namespace Model;

class ComprobantePago extends ActiveRecord {
    //db
    protected static $tabla = 'comprobantespagos';
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

    public function setCitaID($citaID) {
        $this->citaID = $citaID;
    }

    public function setImagenComprobante($imagenComprobante) {
        $this->imagenComprobante = $imagenComprobante;
    }

    public function setFechaSubida($fechaSubida) {
        $this->fechaSubida = $fechaSubida;
    }
}