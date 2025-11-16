<?php
require_once 'modelo/estadisticasModelo.php';
class EstadisticasControl {
    public static function estadisticas() {
    $respuesta = EstadisticasModelo::estadisticas_mostrar();

    // Inicializar arreglo con los 5 estados + TOTAL
    $datos = [
        'En espera del documento físico para ser procesado 0/3' => ['val' => 0, 'inv' => 0, 'total' => 0],
        'En Proceso 1/3' => ['val' => 0, 'inv' => 0, 'total' => 0],
        'En Proceso 2/3' => ['val' => 0, 'inv' => 0, 'total' => 0],
        'En Proceso 3/3 (Sin Entregar)' => ['val' => 0, 'inv' => 0, 'total' => 0],
        'Solicitud Finalizada (Ayuda Entregada)' => ['val' => 0, 'inv' => 0, 'total' => 0],
        'TOTAL' => ['val' => 0, 'inv' => 0, 'total' => 0]
    ];

    if ($respuesta['exito']) {
        foreach ($respuesta['datos'] as $fila) {
            $estado = $fila['estado'];
            if (isset($datos[$estado])) {
                $datos[$estado]['val']   = (int)($fila['total_valido'] ?? 0);
                $datos[$estado]['inv']   = (int)($fila['total_invalido'] ?? 0);
                $datos[$estado]['total'] = (int)($fila['total_general'] ?? 0);
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

    $datos = [
        'En Revisión 1/2' => ['val'=>0,'inv'=>0,'total'=>0],
        'En Proceso 2/2' => ['val'=>0,'inv'=>0,'total'=>0],
        'En Proceso 2/2 (Sin Entregar)' => ['val'=>0,'inv'=>0,'total'=>0],
        'Solicitud Finalizada (Ayuda Entregada)' => ['val'=>0,'inv'=>0,'total'=>0],
        'TOTAL' => ['val'=>0,'inv'=>0,'total'=>0]
    ];

    if ($respuesta['exito']) {
        foreach ($respuesta['datos'] as $fila) {
            $estado = $fila['estado'];
            if (isset($datos[$estado])) {
                $datos[$estado]['val']   = (int)($fila['total_valido'] ?? 0);
                $datos[$estado]['inv']   = (int)($fila['total_invalido'] ?? 0);
                $datos[$estado]['total'] = (int)($fila['total_general'] ?? 0);
            }
        }
    } else {
        error_log("Error al obtener estadísticas: " . $respuesta['error']);
    }

    require_once 'vistas/estadisticas_solicitudes_despacho.php';
}


   public static function estadisticas_solicitudes_desarrollo(){
    $respuesta = EstadisticasModelo::estadisticas_desarrollo();

    $datos = [
        'En espera del documento físico para ser procesado 0/2' => ['val'=>0,'inv'=>0,'total'=>0],
        'En Proceso 1/2' => ['val'=>0,'inv'=>0,'total'=>0],
        'En Proceso 2/2 (Sin Entregar)' => ['val'=>0,'inv'=>0,'total'=>0],
        'Solicitud Finalizada (Ayuda Entregada)' => ['val'=>0,'inv'=>0,'total'=>0],
        'TOTAL' => ['val'=>0,'inv'=>0,'total'=>0]
    ];

    if ($respuesta['exito']) {
        foreach ($respuesta['datos'] as $fila) {
            $estado = $fila['estado'];
            if (isset($datos[$estado])) {
                $datos[$estado]['val']   = (int)($fila['total_valido'] ?? 0);
                $datos[$estado]['inv']   = (int)($fila['total_invalido'] ?? 0);
                $datos[$estado]['total'] = (int)($fila['total_general'] ?? 0);
            }
        }
    } else {
        error_log("Error al obtener estadísticas: " . $respuesta['error']);
    }

    require_once 'vistas/estadisticas_solicitudes_desarrollo.php';
}

}

?>
