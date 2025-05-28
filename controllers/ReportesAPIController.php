<?php

namespace Controllers;

use Model\Reporte;

class ReportesAPIController {

    /* // Card: Ingreso total del mes
    public static function ingresoTotalMes() {
        $datos = Reporte::obtenerIngresoTotalMes();
        echo json_encode($datos);
    }

    // Card: Total de clientes registrados
    public static function totalClientesRegistrados() {
        $datos = Reporte::obtenerClientesRegistrados();
        echo json_encode($datos);
    }

    // Card: Total de servicios
    public static function totalServicios() {
        $datos = Reporte::obtenerTotalServicios();
        echo json_encode($datos);
    }

    // Card: Citas futuras
    public static function totalCitasFuturas() {
        $datos = Reporte::obtenerCitasFuturas();
        echo json_encode($datos);
    } */

    // Gráfico de barras: Ingresos por mes
    public static function ingresosPorMes() {
        $datos = Reporte::obtenerIngresosPorMes();
        echo json_encode($datos);
    }

    // Gráfico de líneas: Ingresos por día
    public static function ingresosPorDia() {
        $datos = Reporte::obtenerIngresosPorDia();
        echo json_encode($datos);
    }

    // Gráfico de pastel: Servicios más solicitados (top 5)
    public static function serviciosSolicitados() {
        $datos = Reporte::obtenerServiciosSolicitados();
        echo json_encode($datos);
    }

    // Tabla o barra horizontal: Clientes más frecuentes (top 5)
    public static function clientesFrecuentes() {
        $datos = Reporte::obtenerClientesFrecuentes();
        echo json_encode($datos);
    }

    // Gráfico de barras: Horarios más demandados (top 5)
    public static function horariosDemandados() {
        $datos = Reporte::obtenerHorariosDemandados();
        echo json_encode($datos);
    }
}