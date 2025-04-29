<?php

namespace Model;

class Horario extends ActiveRecord {
    protected static $tabla = 'horarios';
    protected static $columnasDB = ['id', 'horaInicio', 'horaFin'];

    public $id;
    public $horaInicio;
    public $horaFin;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->horaInicio = $args['horaInicio'] ?? null;
        $this->horaFin = $args['horaFin'] ?? null;
    }
}