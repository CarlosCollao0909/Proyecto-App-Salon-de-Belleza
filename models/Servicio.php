<?php

namespace Model;

class Servicio extends ActiveRecord {
    //db
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio', 'estado'];

    //atributos
    public $id;
    public $nombre;
    public $precio;
    public $estado;

    //constructor
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->estado = $args['estado'] ?? '1';
    }

    //validacion
    public function validar() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Servicio es Obligatorio';
        }
        if (!$this->precio) {
            self::$alertas['error'][] = 'El Precio del Servicio es Obligatorio';
        }
        if (!is_numeric($this->precio)) {
            self::$alertas['error'][] = 'El Precio del Servicio solo debe contener numeros';
        }
        return self::$alertas;
    }
}