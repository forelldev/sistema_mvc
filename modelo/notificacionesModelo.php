<?php
require_once 'conexiondb.php';
  class Notificaciones {
    public static function mostrarNotificaciones($rol) {
            $conexion = DB::conectar();
            $resultadoFinal = [];

            // Definir estados según el rol
            switch ($rol) {
                case 1:
                    $estado = ['En espera del documento físico para ser procesado 0/3', 'En Proceso 1/3'];
                    break;
                case 2:
                    $estado = ['En Proceso 2/3'];
                    break;
                case 3:
                    $estado = ['En Proceso 3/3 (Sin entregar)'];
                    break;
                case 4:
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

            // Consulta de solicitud de ayuda con detalles
            if (!empty($estado)) {
                $placeholders = implode(',', array_fill(0, count($estado), '?'));
                $consultaAyuda = "
                    SELECT 
                        sa.*, 
                        saf.fecha, saf.fecha_modificacion, saf.visto,
                        sc.correo_enviado,
                        cat.tipo_ayuda, cat.categoria,
                        des.descripcion, des.promotor, des.observaciones
                    FROM solicitud_ayuda sa
                    LEFT JOIN solicitud_ayuda_fecha saf ON sa.id_doc = saf.id_doc
                    LEFT JOIN solicitud_ayuda_correo sc ON sa.id_doc = sc.id_doc
                    LEFT JOIN solicitud_categoria cat ON sa.id_doc = cat.id_doc
                    LEFT JOIN solicitud_descripcion des ON sa.id_doc = des.id_doc
                    WHERE saf.visto = 0 AND sa.estado IN ($placeholders)
                    AND sa.invalido = 0
                    ORDER BY saf.fecha DESC
                ";
                $busquedaAyuda = $conexion->prepare($consultaAyuda);
                $busquedaAyuda->execute($estado);
                $resultadoAyuda = $busquedaAyuda->fetchAll(PDO::FETCH_ASSOC);

                if ($resultadoAyuda) {
                    $resultadoFinal['ayuda'] = $resultadoAyuda;
                }
            }

            // Consulta de despacho solo para rol 2
            if ($rol == 2) {
                $consultaDespacho = "
                    SELECT 
                        d.*, 
                        dd.asunto, dd.creador,
                        df.fecha, df.fecha_modificacion, df.visto
                    FROM despacho d
                    LEFT JOIN despacho_descripcion dd ON d.id_despacho = dd.id_despacho
                    LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
                    WHERE df.visto = 0
                    AND d.invalido = 0
                    ORDER BY df.fecha DESC
                ";
                $busquedaDespacho = $conexion->prepare($consultaDespacho);
                $busquedaDespacho->execute();
                $resultadoDespacho = $busquedaDespacho->fetchAll(PDO::FETCH_ASSOC);

                if ($resultadoDespacho) {
                    $resultadoFinal['despacho'] = $resultadoDespacho;
                }
            }

            // Respuesta final
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


   public static function mostrar_notis($id_doc) {
        try {
            $conexion = DB::conectar();

            $consulta = "
                SELECT 
                    sa.*, 
                    saf.fecha, saf.fecha_modificacion, saf.visto,
                    sc.correo_enviado,
                    cat.tipo_ayuda, cat.categoria,
                    des.descripcion, des.promotor, des.observaciones,
                    sol.nombre AS nombre,
                    sol.apellido AS apellido
                FROM solicitud_ayuda sa
                LEFT JOIN solicitud_ayuda_fecha saf ON sa.id_doc = saf.id_doc
                LEFT JOIN solicitud_ayuda_correo sc ON sa.id_doc = sc.id_doc
                LEFT JOIN solicitud_categoria cat ON sa.id_doc = cat.id_doc
                LEFT JOIN solicitud_descripcion des ON sa.id_doc = des.id_doc
                LEFT JOIN solicitantes sol ON sa.ci = sol.ci
                WHERE sa.id_doc = :id_doc
            ";


            $busqueda = $conexion->prepare($consulta);
            $busqueda->bindParam(':id_doc', $id_doc, PDO::PARAM_STR);
            $busqueda->execute();
            $resultado = $busqueda->fetchAll(PDO::FETCH_ASSOC);

            if ($resultado) {
                return [
                    'exito' => true,
                    'datos' => $resultado
                ];
            } else {
                return [
                    'exito' => false,
                    'mensaje' => 'No se encontraron datos para el ID proporcionado.'
                ];
            }
        } catch (PDOException $e) {
            error_log("Error en mostrar_notis: " . $e->getMessage());
            return [
                'exito' => false,
                'mensaje' => 'Error al realizar la búsqueda.'
            ];
        }
    }


    public static function marcar_vista() {
    $conexion = DB::conectar();
    $consulta = "UPDATE solicitud_ayuda_fecha SET visto = 1 WHERE visto = 0";
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

    public static function marcar_vistaDespacho() {
    $conexion = DB::conectar();

    $consulta1 = "UPDATE solicitud_ayuda_fecha SET visto = 1 WHERE visto = 0";
    $consulta2 = "UPDATE despacho_fecha SET visto = 1 WHERE visto = 0";

    try {
        // Ejecutar primera consulta
        $stmt1 = $conexion->prepare($consulta1);
        $stmt1->execute();
        $filas1 = $stmt1->rowCount();

        // Ejecutar segunda consulta
        $stmt2 = $conexion->prepare($consulta2);
        $stmt2->execute();
        $filas2 = $stmt2->rowCount();

        return [
            'exito' => true,
            'datos' => [
                'solicitud_ayuda_actualizadas' => $filas1,
                'despacho_actualizadas' => $filas2,
                'total_actualizadas' => $filas1 + $filas2
            ]
        ];
    } catch (PDOException $e) {
        return [
            'exito' => false,
            'mensaje' => 'Error en la actualización: ' . $e->getMessage()
        ];
    }
}


  }
?>