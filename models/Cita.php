<?php

namespace Model;

class Cita extends ActiveRecord {
    //db
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'estado', 'horarioID', 'usuarioID', 'servicioID', 'formaPagoID'];

    public $id;
    public $fecha;
    public $estado;
    public $horarioID;
    public $usuarioID;
    public $servicioID;
    public $formaPagoID;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->estado = $args['estado'] ?? 'Confirmada';
        $this->horarioID = $args['horarioID'] ?? '';
        $this->usuarioID = $args['usuarioID'] ?? '';
        $this->servicioID = $args['servicioID'] ?? '';
        $this->formaPagoID = $args['formaPagoID'] ?? '';
    }
}