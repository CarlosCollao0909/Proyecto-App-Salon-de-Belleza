<?php

namespace Model;

class AdminCita extends ActiveRecord {
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'estado', 'cliente', 'servicio', 'precio', 'horario', 'formaPago', 'comprobantePago'];

    public $id;
    public $fecha;
    public $estado;
    public $cliente;
    public $servicio;
    public $precio;
    public $horario;
    public $formaPago;
    public $comprobantePago;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->estado = $args['estado'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->horario = $args['horario'] ?? '';
        $this->formaPago = $args['formaPago'] ?? '';
        $this->comprobantePago = $args['comprobantePago'] ?? '';
    }

    public static function obtenerCitasPorFecha($fecha) {
        $query = "SELECT 
        citas.id, 
        citas.fecha, 
        citas.estado,
        CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS cliente, 
        usuarios.email, 
        usuarios.telefono, 
        servicios.nombre AS servicio, 
        servicios.precio, 
        CONCAT(horarios.horaInicio, ' - ', horarios.horaFin) AS horario,
        formaspagos.tipo AS formaPago, 
        comprobantespagos.imagenComprobante AS comprobantePago
        FROM citas
        LEFT JOIN usuarios ON citas.usuarioID = usuarios.id
        LEFT JOIN servicios ON citas.servicioID = servicios.id
        LEFT JOIN horarios ON citas.horarioID = horarios.id
        LEFT JOIN formaspagos ON citas.formaPagoID = formaspagos.id
        LEFT JOIN comprobantespagos ON citas.id = comprobantespagos.citaID
        WHERE citas.fecha = '$fecha'
        ORDER BY citas.horarioID";

        $resultado = self::customQuery($query);
        return $resultado;
    }

    public static function obtenerTodasCitas() {
        $query = "SELECT 
        citas.id, 
        citas.fecha, 
        citas.estado,
        CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS cliente, 
        usuarios.email, 
        usuarios.telefono, 
        servicios.nombre AS servicio, 
        servicios.precio, 
        CONCAT(horarios.horaInicio, ' - ', horarios.horaFin) AS horario,
        formaspagos.tipo AS formaPago, 
        comprobantespagos.imagenComprobante AS comprobantePago
        FROM citas
        LEFT JOIN usuarios ON citas.usuarioID = usuarios.id
        LEFT JOIN servicios ON citas.servicioID = servicios.id
        LEFT JOIN horarios ON citas.horarioID = horarios.id
        LEFT JOIN formaspagos ON citas.formaPagoID = formaspagos.id
        LEFT JOIN comprobantespagos ON citas.id = comprobantespagos.citaID";

        $resultado = self::customQuery($query);
        return $resultado;
    }
}

