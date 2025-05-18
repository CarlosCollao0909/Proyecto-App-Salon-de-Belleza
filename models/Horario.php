<?php

namespace Model;

class Horario extends ActiveRecord {
    protected static $tabla = 'horarios';
    protected static $columnasDB = ['id', 'horaInicio', 'horaFin', 'estado'];

    public $id;
    public $horaInicio;
    public $horaFin;
    public $estado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->horaInicio = $args['horaInicio'] ?? '';
        $this->horaFin = $args['horaFin'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }
}