<?php

namespace Model;

use Model\ActiveRecord;

class Reporte extends ActiveRecord {

    //cards
    public static function obtenerIngresoTotalMes() {
        $query = "SELECT 
            COALESCE(SUM(s.precio), 0) as ingresos_mes
        FROM citas c
        INNER JOIN servicios s ON c.servicioID = s.id
        WHERE c.estado = 'finalizada' 
            AND MONTH(c.fecha) = MONTH(CURDATE()) 
            AND YEAR(c.fecha) = YEAR(CURDATE());";

        $resultado = self::customQuery($query);
        return array_shift($resultado);
    }

    public static function obtenerClientesRegistrados() {
        $query = "SELECT COUNT(*) as total_clientes
        FROM usuarios 
        WHERE admin = 0 OR admin IS NULL;";
        $resultado = self::customQuery($query);
        return array_shift($resultado);
    }

    public static function obtenerTotalServicios() {
        $query = "SELECT COUNT(*) as total_servicios
        FROM servicios;";
        $resultado = self::customQuery($query);
        return array_shift($resultado);
    }

    public static function obtenerCitasFuturas() {
        $query = "SELECT COUNT(*) as citas_futuras
        FROM citas 
        WHERE fecha >= CURDATE() 
            AND (estado = 'pendiente' OR estado = 'confirmada');";
        $resultado = self::customQuery($query);
        return array_shift($resultado);
    }

    //graficas
    public static function obtenerIngresosPorMes() {
        $query = "SELECT 
            DATE_FORMAT(c.fecha, '%Y-%m') AS mes,
            SUM(s.precio) AS total_ingresos
        FROM citas c
        JOIN servicios s ON c.servicioID = s.id
        WHERE c.estado = 'finalizada'
        GROUP BY mes
        ORDER BY mes;";
        $resultado = self::customQuery($query);
        return $resultado;
    }

    public static function obtenerIngresosPorDia() {
        $query = "SELECT 
            c.fecha,
            SUM(s.precio) AS total_ingresos
        FROM citas c
        JOIN servicios s ON c.servicioID = s.id
        WHERE c.estado = 'finalizada'
        GROUP BY c.fecha
        ORDER BY c.fecha;";
        $resultado = self::customQuery($query);
        return $resultado;
    }

    public static function obtenerServiciosSolicitados() {
        $query = "SELECT 
            s.nombre AS servicio,
            COUNT(*) AS cantidad
        FROM 
            citas c
        JOIN 
            servicios s ON c.servicioID = s.id
        GROUP BY 
            s.id
        ORDER BY 
            cantidad DESC
        LIMIT 5;";
        $resultado = self::customQuery($query);
        return $resultado;
    }

    public static function obtenerClientesFrecuentes() {
        $query = "SELECT 
            CONCAT(u.nombre, ' ', u.apellido) AS cliente,
            COUNT(*) AS cantidad_citas
        FROM 
            citas c
        JOIN 
            usuarios u ON c.usuarioID = u.id
        GROUP BY 
            u.id
        ORDER BY 
            cantidad_citas DESC
        LIMIT 5;";
        $resultado = self::customQuery($query);
        return $resultado;
    }

    public static function obtenerHorariosDemandados() {
        $query = "SELECT 
            h.horaInicio AS horario,
            COUNT(*) AS cantidad
        FROM 
            citas c
        JOIN 
            horarios h ON c.horarioID = h.id
        GROUP BY 
            h.horaInicio
        ORDER BY 
            cantidad DESC
        LIMIT 5;";
        $resultado = self::customQuery($query);
        return $resultado;
    }

    public static function obtenerHistorialPorCliente($clienteID) {
        $query = "SELECT 
            c.id,
            c.fecha,
            s.nombre AS servicio,
            s.precio,
            c.estado
        FROM 
            citas c
        JOIN 
            servicios s ON c.servicioID = s.id
        WHERE 
            c.usuarioID = '$clienteID'
        ORDER BY 
            c.fecha DESC;";

        $resultado = self::customQuery($query);
        return $resultado;
    }
}
