<?php
require_once 'modelo/estadisticasModelo.php';
class EstadisticasControl {
    public static function estadisticas() {
        $respuesta = EstadisticasModelo::estadisticas_mostrar();

        // Inicializar arreglo con los 5 estados
        $datos = [
            'En espera del documento físico para ser procesado 0/3' => 0,
            'En Proceso 1/3' => 0,
            'En Proceso 2/3' => 0,
            'En Proceso 3/3 (Sin Entregar)' => 0,
            'Solicitud Finalizada (Ayuda Entregada)' => 0
        ];

        if ($respuesta['exito']) {
            foreach ($respuesta['datos'] as $fila) {
                $estado = $fila['estado'];
                $total = $fila['total'];
                if (isset($datos[$estado])) {
                    $datos[$estado] = $total;
                }
            }
        } else {
            error_log("Error al obtener estadísticas: " . $respuesta['error']);
        }

        // Pasar datos a la vista
        require_once 'vistas/estadisticas_solicitudes.php';
    }

    public static function estadisticas_solicitudes_despacho(){
        $respuesta = EstadisticasModelo::estadisticas_despacho();
        // Inicializar arreglo con los 5 estados
        $datos = [
            'En Revisión 1/2' => 0,
            'En Proceso 2/2 (Sin entregar)' => 0,
            'Solicitud Finalizada (Ayuda Entregada)' => 0
        ];

        if ($respuesta['exito']) {
            foreach ($respuesta['datos'] as $fila) {
                $estado = $fila['estado'];
                $total = $fila['total'];
                if (isset($datos[$estado])) {
                    $datos[$estado] = $total;
                }
            }
        } else {
            error_log("Error al obtener estadísticas: " . $respuesta['error']);
        }
        require_once 'vistas/estadisticas_solicitudes_despacho.php';
    }

    public static function estadisticas_solicitudes_desarrollo(){
        $respuesta = EstadisticasModelo::estadisticas_desarrollo();
        // Inicializar arreglo con los 5 estados
        $datos = [
            'En espera del documento físico para ser procesado 0/2' => 0,
            'En Proceso 1/2' => 0,
            'En Proceso 2/2 (Sin entregar)' => 0,
            'Solicitud Finalizada (Ayuda Entregada)' => 0
        ];
        if ($respuesta['exito']) {
            foreach ($respuesta['datos'] as $fila) {
                $estado = $fila['estado'];
                $total = $fila['total'];
                if (isset($datos[$estado])) {
                    $datos[$estado] = $total;
                }
            }
        } else {
            error_log("Error al obtener estadísticas: " . $respuesta['error']);
        }
        require_once 'vistas/estadisticas_solicitudes_desarrollo.php';
    }
}

?>
