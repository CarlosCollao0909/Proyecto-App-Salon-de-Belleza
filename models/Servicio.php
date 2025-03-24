<?php

namespace Model;

class Servicio extends ActiveRecord {
    //db
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    //atributos
    public $id;
    public $nombre;
    public $precio;

    //constructor
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }
}