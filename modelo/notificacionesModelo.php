<?php
require_once 'conexiondb.php';
  class Notificaciones {
    public static function mostrarNotificaciones($rol) {
        try {
            $conexion = DB::conectar();
            $resultadoFinal = [];
            // Definir estados según el rol
            switch ($rol) {
                case 1:
                    $estado = ['En espera del documento físico para ser procesado 0/3', 'En Proceso 1/3','Solicitud Finalizada (Ayuda Entregada)'];
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
                        'En Proceso 3/3 (Sin entregar)',
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
                    WHERE saf.visto = 0 
                    AND sa.estado IN ($placeholders)
                    AND sa.invalido = 0
                    ORDER BY saf.fecha DESC
                ";

                $busquedaAyuda = $conexion->prepare($consultaAyuda);
                $busquedaAyuda->execute($estado);
                $resultadoAyuda = $busquedaAyuda->fetchAll(PDO::FETCH_ASSOC);

                if ($resultadoAyuda) {
                    $resultadoFinal['ayuda'] = [
                        'tabla' => 'solicitud_ayuda_fecha',
                        'id_name' => 'id_doc',
                        'datos' => $resultadoAyuda
                    ];
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
        } catch (Exception $e) {
            return [
                'exito' => false,
                'mensaje' => 'Error al obtener notificaciones: ' . $e->getMessage()
            ];
        }
    }


   public static function mostrar_notificaciones_despacho() {
            try {
                $conexion = DB::conectar();
                $resultadoFinal = [];

                $rol = $_SESSION['id_rol'] ?? null;

                // Base de la consulta
                $consultaDespacho = "
                    SELECT 
                        d.*, 
                        di.*, 
                        df.*,
                        dc.*
                    FROM despacho d
                    LEFT JOIN despacho_info di ON d.id_despacho = di.id_despacho
                    LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
                    LEFT JOIN despacho_categoria dc ON d.id_despacho = dc.id_despacho
                    WHERE df.visto = 0
                    AND d.invalido = 0
                ";

                // Filtro adicional según el rol
                if ($rol == 3) {
                    $consultaDespacho .= " AND d.estado = 'Aprobado 2/2'";
                }

                 if ($rol == 2) {
                    $consultaDespacho .= " AND (d.estado = 'En Revisión 1/2' OR d.estado = 'Solicitud Finalizada (Ayuda Entregada)')";
                }

                // Orden final
                $consultaDespacho .= " ORDER BY df.fecha DESC";

                // Ejecutar
                $busquedaDespacho = $conexion->prepare($consultaDespacho);
                $busquedaDespacho->execute();
                $resultadoDespacho = $busquedaDespacho->fetchAll(PDO::FETCH_ASSOC);

                if ($resultadoDespacho) {
                    foreach ($resultadoDespacho as &$item) {
                        $item['id_doc'] = $item['id_despacho'];
                    }
                    unset($item);

                    $resultadoFinal['despacho'] = [
                        'tabla' => 'despacho_fecha',
                        'id_name' => 'id_despacho',
                        'datos' => $resultadoDespacho
                    ];
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

            } catch (Exception $e) {
                error_log("Error al obtener notificaciones de despacho: " . $e->getMessage());
                return [
                    'exito' => false,
                    'mensaje' => 'Error al obtener notificaciones: ' . $e->getMessage()
                ];
            }
        }


    public static function mostrar_notificaciones_desarrollo() {
        try {
            $conexion = DB::conectar();
            $resultadoFinal = [];

            $consultaDesarrollo = "
                SELECT 
                    sd.*, 
                    sdi.*,
                    sdf.*
                FROM solicitud_desarrollo sd
                LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                WHERE sdf.visto = 0
                AND sd.invalido = 0
                ORDER BY sdf.fecha DESC
            ";

            $busquedaDesarrollo = $conexion->prepare($consultaDesarrollo);
            $busquedaDesarrollo->execute();
            $resultadoDesarrollo = $busquedaDesarrollo->fetchAll(PDO::FETCH_ASSOC);

            if ($resultadoDesarrollo) {
            // Asignar id_doc a cada notificación individual
            foreach ($resultadoDesarrollo as &$item) {
                $item['id_doc'] = $item['id_des'];
            }
            unset($item); // buena práctica para evitar referencias residuales

            $resultadoFinal['desarrollo'] = [
                'tabla' => 'solicitud_desarrollo_fecha',
                'id_name' => 'id_des',
                'datos' => $resultadoDesarrollo
            ];
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

        } catch (Exception $e) {
            error_log("Error al obtener notificaciones de desarrollo: " . $e->getMessage());
            return [
                'exito' => false,
                'mensaje' => 'Error al obtener notificaciones: ' . $e->getMessage()
            ];
        }
    }



   public static function mostrar_notis($id_doc) {
        try {
            $conexion = DB::conectar();

            $consulta = "
                SELECT 
                    sa.*, 
                    saf.*,
                    sc.*,
                    cat.*,
                    des.*,
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

   public static function mostrar_notis_desarrollo($id_des) {
    try {
        $conexion = DB::conectar();

        $consulta = "
            SELECT 
                sd.*, 
                sdi.*, 
                sdt.*, 
                sdf.*, 
                sol.*, 
                lab.examenes
            FROM solicitud_desarrollo sd
            LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
            LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
            LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
            LEFT JOIN solicitantes sol ON sd.ci = sol.ci
            LEFT JOIN (
                SELECT id_des, GROUP_CONCAT(examen SEPARATOR ', ') AS examenes
                FROM solicitud_desarrollo_laboratorio
                GROUP BY id_des
            ) AS lab ON lab.id_des = sd.id_des
            WHERE sd.id_des = :id_des
        ";

        $busqueda = $conexion->prepare($consulta);
        $busqueda->bindParam(':id_des', $id_des, PDO::PARAM_STR);
        $busqueda->execute();
        $resultado = $busqueda->fetchAll(PDO::FETCH_ASSOC); // ← solo una fila esperada

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


      public static function mostrar_notis_despacho($id_despacho) {
        try {
            $conexion = DB::conectar();

            $consulta = "
                SELECT 
                    d.*, 
                    di.*, 
                    df.*, 
                    dc.*, 
                    sol.*
                FROM despacho d
                LEFT JOIN despacho_info di ON d.id_despacho = di.id_despacho
                LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
                LEFT JOIN despacho_categoria dc ON d.id_despacho = dc.id_despacho
                LEFT JOIN solicitantes sol ON d.ci = sol.ci
                WHERE d.id_despacho = :id_despacho
                ORDER BY df.fecha DESC
            ";

            $busqueda = $conexion->prepare($consulta);
            $busqueda->bindParam(':id_despacho', $id_despacho, PDO::PARAM_STR);
            $busqueda->execute();
            $resultado = $busqueda->fetchAll(PDO::FETCH_ASSOC);

            if ($resultado && count($resultado) > 0) {
                return [
                    'exito' => true,
                    'datos' => $resultado
                ];
            } else {
                return [
                    'exito' => false,
                    'mensaje' => 'No se encontraron despachos válidos.'
                ];
            }
        } catch (PDOException $e) {
            error_log("Error en mostrar_notis_despacho: " . $e->getMessage());
            return [
                'exito' => false,
                'mensaje' => 'Error al realizar la búsqueda.'
            ];
        }
    }




   public static function marcar_vista($rol) {
        $conexion = DB::conectar();
        $total_actualizadas = 0;

        // 1. solicitud_ayuda + solicitud_ayuda_fecha
        $consulta1 = null;
        if ($rol == 1) {
            $consulta1 = "UPDATE solicitud_ayuda_fecha saf
                        JOIN solicitud_ayuda sa ON sa.id_doc = saf.id_doc
                        SET saf.visto = 1
                        WHERE saf.visto = 0 AND sa.estado IN (
                            'En espera del documento físico para se procesado',
                            'En Proceso 1/3'
                        )";
        } elseif ($rol == 2) {
            $consulta1 = "UPDATE solicitud_ayuda_fecha saf
                        JOIN solicitud_ayuda sa ON sa.id_doc = saf.id_doc
                        SET saf.visto = 1
                        WHERE saf.visto = 0 AND sa.estado = 'En Proceso 2/3'";
        } elseif ($rol == 3) {
            $consulta1 = "UPDATE solicitud_ayuda_fecha saf
                        JOIN solicitud_ayuda sa ON sa.id_doc = saf.id_doc
                        SET saf.visto = 1
                        WHERE saf.visto = 0 AND sa.estado = 'En Proceso 3/3 (Sin Entregar)'";
        } elseif ($rol == 4) {
            $consulta1 = "UPDATE solicitud_ayuda_fecha SET visto = 1 WHERE visto = 0";
        }

        if ($consulta1) {
            $busqueda1 = $conexion->prepare($consulta1);
            if ($busqueda1->execute()) {
                $total_actualizadas += $busqueda1->rowCount();
            }
        }

        // 2. despacho + despacho_fecha
        if ($rol == 2) {
            $consulta2 = "UPDATE despacho_fecha df
                        JOIN despacho d ON d.id_despacho = df.id_despacho
                        SET df.visto = 1
                        WHERE df.visto = 0 AND d.estado = 'En Revisión 1/2' OR d.estado = 'Solicitud Finalizada (Ayuda Entregada)'";
        } elseif ($rol == 3) {
            $consulta2 = "UPDATE despacho_fecha df
                        JOIN despacho d ON d.id_despacho = df.id_despacho
                        SET df.visto = 1
                        WHERE df.visto = 0 AND d.estado = 'Aprobado 2/2'";
        } elseif ($rol == 4) {
            $consulta2 = "UPDATE despacho_fecha SET visto = 1 WHERE visto = 0";
        }

        if (isset($consulta2)) {
            $busqueda2 = $conexion->prepare($consulta2);
            if ($busqueda2->execute()) {
                $total_actualizadas += $busqueda2->rowCount();
            }
        }

        // 3. solicitud_desarrollo + solicitud_desarrollo_fecha (solo rol 4)
        if ($rol == 4) {
            $consulta3 = "UPDATE solicitud_desarrollo_fecha sdf
                        JOIN solicitud_desarrollo sd ON sd.id_des = sdf.id_des
                        SET sdf.visto = 1
                        WHERE sdf.visto = 0";
            $busqueda3 = $conexion->prepare($consulta3);
            if ($busqueda3->execute()) {
                $total_actualizadas += $busqueda3->rowCount();
            }
        }

        return [
            'exito' => true,
            'datos' => ['filas_actualizadas' => $total_actualizadas]
        ];
    }




//     public static function marcar_vistaDespacho() {
//     $conexion = DB::conectar();

//     $consulta1 = "UPDATE solicitud_ayuda_fecha SET visto = 1 WHERE visto = 0";
//     $consulta2 = "UPDATE despacho_fecha SET visto = 1 WHERE visto = 0";

//     try {
//         // Ejecutar primera consulta
//         $stmt1 = $conexion->prepare($consulta1);
//         $stmt1->execute();
//         $filas1 = $stmt1->rowCount();

//         // Ejecutar segunda consulta
//         $stmt2 = $conexion->prepare($consulta2);
//         $stmt2->execute();
//         $filas2 = $stmt2->rowCount();

//         return [
//             'exito' => true,
//             'datos' => [
//                 'solicitud_ayuda_actualizadas' => $filas1,
//                 'despacho_actualizadas' => $filas2,
//                 'total_actualizadas' => $filas1 + $filas2
//             ]
//         ];
//     } catch (PDOException $e) {
//         return [
//             'exito' => false,
//             'mensaje' => 'Error en la actualización: ' . $e->getMessage()
//         ];
//     }
// }
    public static function marcar_vista_uno($id_doc,$id_name,$tabla){
        try{
            $conexion = DB::conectar();
            $consulta = "UPDATE $tabla SET visto = 1 WHERE $id_name = $id_doc";
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
        catch(Exception $e){
            return [
            'exito' => false,
            'mensaje' => 'Error en la actualización: ' . $e->getMessage()
        ];
        }
    }



  }
?>