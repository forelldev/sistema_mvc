<?php
require_once 'conexiondb.php';
  class Notificaciones {
      public static function mostrarNotificaciones($rol) {
        $conexion = DB::conectar();
        $resultadoFinal = [];
        switch ($rol) {
            case 1:
                // Este rol tendrá dos estados
                $estado = ['En espera del documento físico para ser procesado 0/3', 'En Proceso 1/3'];
                break;
            case 2:
                $estado = ['En Proceso 2/3'];
                // Consulta adicional para solicitud_despacho
                $consulta2 = "SELECT * FROM despacho WHERE visto = 0 ORDER BY fecha DESC";
                $busqueda2 = $conexion->prepare($consulta2);
                $busqueda2->execute();
                $resultadoDespacho = $busqueda2->fetchAll(PDO::FETCH_ASSOC);
                if ($resultadoDespacho) {
                    $resultadoFinal['despacho'] = $resultadoDespacho;
                }
                break;
            case 3:
                $estado = ['En Proceso 3/3 (Sin entregar)'];
                break;
            case 4:
                // Este rol tendrá todos los estados menos la de solicitud despacho
                $estado = [
                    'En espera del documento físico para ser procesado 0/3',
                    'En Proceso 1/3',
                    'En Proceso 2/3',
                    'En Proceso 3/3',
                    'Solicitud Finalizada (Ayuda Entregada)'
                ];
                break;
            default:
                return [
                    'exito' => false,
                    'mensaje' => 'Rol no válido'
                ];
        }

        // Construir consulta dinámica según cantidad de estados
        if (is_array($estado)) {
            $placeholders = implode(',', array_fill(0, count($estado), '?'));
            $consulta = "SELECT * FROM solicitud_ayuda WHERE visto = 0 AND estado IN ($placeholders) ORDER BY fecha DESC";
            $busqueda = $conexion->prepare($consulta);
            $busqueda->execute($estado);
        } else {
            $consulta = "SELECT * FROM solicitud_ayuda WHERE visto = 0 AND estado = ? ORDER BY fecha DESC";
            $busqueda = $conexion->prepare($consulta);
            $busqueda->execute([$estado]);
        }

        $resultadoAyuda = $busqueda->fetchAll(PDO::FETCH_ASSOC);
        if ($resultadoAyuda) {
            $resultadoFinal['ayuda'] = $resultadoAyuda;
        }

        if (!empty($resultadoFinal)) {
            return [
                'exito' => true,
                'datos' => $resultadoFinal
            ];
        } else {
            return [
                'exito' => false,
                'mensaje' => 'No se encontraron notificaciones'
            ];
        }
    }

    public static function mostrar_notis($id_doc){
        $conexion = DB::conectar();
        $consulta = "SELECT * FROM solicitud_ayuda WHERE id_doc = '$id_doc'";
        $busqueda = $conexion->prepare($consulta);
        $busqueda->execute();
        $resultado = $busqueda->fetchAll(PDO::FETCH_ASSOC);
            if ($resultado) {
                // Usuario encontrado, devolver datos
                return [
                    'exito' => true,
                    'datos' => $resultado
                ];
            } else {
                // No se encontró el usuario
                return [
                    'exito' => false,
                    'mensaje' => 'Ocurrió un error realizando la búsqueda'
                ];
            }
    }

    public static function marcar_vista() {
    $conexion = DB::conectar();
    $consulta = "UPDATE solicitud_ayuda SET visto = 1 WHERE visto = 0";
    $busqueda = $conexion->prepare($consulta);
    if ($busqueda->execute()) {
        $filas_afectadas = $busqueda->rowCount();
        return [
            'exito' => true,
            'datos' => ['filas_actualizadas' => $filas_afectadas]
        ];
    } else {
        return [
            'exito' => false,
            'mensaje' => 'Ocurrió un error realizando la actualización'
        ];
    }
}

  }
?>