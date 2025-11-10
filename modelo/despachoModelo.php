<?php 
require_once 'conexiondb.php';
require_once 'correoModelo.php';
class Despacho{
       // MOSTRAR LISTA DE SOLICITUDES DE DESPACHO:
    public static function buscarLista() {
            $conexion = DB::conectar();
            $rol = $_SESSION['id_rol'] ?? null;

            // Base de la consulta
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
                WHERE d.invalido = 0
            ";

            // Filtro adicional según el rol
            if ($rol == 3) {
                $consulta .= " AND d.estado = 'En Proceso 2/2 (Sin Entregar)'";
            }

            // Orden final
            $consulta .= " ORDER BY df.fecha DESC";

            // Ejecutar
            $busqueda = $conexion->prepare($consulta);
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
                    'mensaje' => 'Ocurrió un error realizando la búsqueda'
                ];
            }
        }

    // BUSCAR POR CEDULA DE IDENTIDAD CUANDO SE BUSQUE ANTES DE RELLENAR FORMULARIO
    public static function buscarCi($ci) {
            $db = DB::conectar();

            // Buscar el solicitante principal
            $stmt = $db->prepare("SELECT * FROM solicitantes WHERE ci = :ci");
            $stmt->bindParam(':ci', $ci);
            $stmt->execute();
            $solicitante = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$solicitante) {
                return ['exito' => false];
            }

            $id = $solicitante['id_solicitante'];

            // Buscar datos relacionados
            $datos = [
                'solicitante' => $solicitante,
                'comunidad' => self::buscarUno($db, 'solicitantes_comunidad', $id),
                'info' => self::buscarUno($db, 'solicitantes_info', $id),
            ];

            return ['exito' => true, 'mostrar' => $datos];
        }

    private static function buscarUno($db, $tabla, $id) {
        $stmt = $db->prepare("SELECT * FROM $tabla WHERE id_solicitante = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // PROCESAR FORMULARIO UNA VEZ ENVIADO:
  public static function enviarForm($data) {
    $db = DB::conectar();
    $db->beginTransaction();
    try {
        // Verificar si el id_manual ya existe
        $checkStmt = $db->prepare("SELECT COUNT(*) FROM despacho WHERE id_manual = :id_manual");
        $checkStmt->execute([':id_manual' => $data['id_manual']]);
        $exists = $checkStmt->fetchColumn();
        if ($exists > 0) {
            throw new Exception("❌ El número de documento ya está registrado.");
        }

        // Validar campos obligatorios
        $camposObligatorios = [
            'id_manual', 'ci', 'descripcion', 'fecha','nombre','apellido','telefono','direc_habita','tipo_ayuda','categoria'
        ];
        foreach ($camposObligatorios as $campo) {
            if (!isset($data[$campo]) || $data[$campo] === '') {
                throw new Exception("Falta el campo obligatorio: $campo");
            }
        }

        // Obtener datos del promotor
        $stmt = $db->prepare("SELECT nombre, apellido FROM usuarios_info WHERE ci = :ci");
        $stmt->execute([':ci' => $data['ci_user']]);
        $promotor = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$promotor) {
            throw new Exception("No se encontró el promotor con CI: " . $data['ci_user']);
        }
        $nombrePromotor = $promotor['nombre'] . ' ' . $promotor['apellido'];

        // Insertar solicitud de ayuda
        $stmt = $db->prepare("
            INSERT INTO despacho (
                id_manual, ci, estado, invalido
            ) VALUES (
                :id_manual, :ci, :estado, :invalido
            )
        ");
        $stmt->execute([
            ':id_manual' => $data['id_manual'],
            ':ci' => $data['ci'],
            ':estado' => 'En Revisión 1/2',
            ':invalido' => 0
        ]);
        $id_despacho = $db->lastInsertId();

        // Descripción y creador
        $stmt = $db->prepare("
            INSERT INTO despacho_info (
                id_despacho, descripcion, creador
            ) VALUES (
                :id_despacho, :descripcion, :creador
            )
        ");
        $stmt->execute([
            ':id_despacho' => $id_despacho,
            ':descripcion' => $data['descripcion'],
            ':creador' => $nombrePromotor
        ]);

        // Fechas y visto
        $stmt = $db->prepare("
            INSERT INTO despacho_fecha (
                id_despacho, fecha, fecha_modificacion, fecha_renovacion, visto
            ) VALUES (
                :id_despacho, :fecha, :fecha_modificacion, :fecha_renovacion, :visto
            )
        ");
        $stmt->execute([
            ':id_despacho' => $id_despacho,
            ':fecha' => $data['fecha'],
            ':fecha_modificacion' => $data['fecha'],
            ':fecha_renovacion' => $data['fecha'],
            ':visto' => 0
        ]);

        // Categoría y tipo de ayuda
        $stmt = $db->prepare("
            INSERT INTO despacho_categoria (
                id_despacho, categoria, tipo_ayuda
            ) VALUES (
                :id_despacho, :categoria, :tipo_ayuda 
            )
        ");
        $stmt->execute([
            ':id_despacho' => $id_despacho,
            ':categoria' => $data['categoria'],
            ':tipo_ayuda' => $data['tipo_ayuda']
        ]);

        // Estado de correo
        $stmt = $db->prepare("
            INSERT INTO despacho_correo (
                id_despacho, correo_enviado
            ) VALUES (
                :id_despacho, :correo_enviado
            )
        ");
        $stmt->execute([
            ':id_despacho' => $id_despacho,
            ':correo_enviado' => 0,
        ]);

        $mensaje_nuevo = null;
        $id_solicitante = $data['id_solicitante'] ?? null;

        if ($id_solicitante) {
            self::actualizarSolicitante($db, $id_solicitante, $data);
        } else {
            // Buscar por CI si no se proporcionó id_solicitante
            $stmt = $db->prepare("SELECT id_solicitante FROM solicitantes WHERE ci = ?");
            $stmt->execute([$data['ci']]);
            $id_solicitante = $stmt->fetchColumn();

            if ($id_solicitante) {
                self::actualizarSolicitante($db, $id_solicitante, $data);
            } else {
                // Insertar nuevo solicitante
                $stmt = $db->prepare("INSERT INTO solicitantes (nombre, apellido, ci, correo) VALUES (?, ?, ?, ?)");
                $stmt->execute([$data['nombre'], $data['apellido'], $data['ci'], $data['correo']]);
                $id_solicitante = $db->lastInsertId();

                self::insertarSolicitante($db, $id_solicitante, $data);
                $mensaje_nuevo = "Se ha registrado un nuevo beneficiario.";
            }
        }

        $db->commit();
        return ['exito' => true, 'id_despacho' => $id_despacho, 'mensaje_nuevo' => $mensaje_nuevo];

    } catch (Exception $e) {
        $db->rollBack();
        error_log("Error al registrar solicitud: " . $e->getMessage());
        return ['exito' => false, 'error' => $e->getMessage()];
    }
}

private static function actualizarSolicitante($db, $id, $data) {
    $db->prepare("
        UPDATE solicitantes
        SET nombre = ?, apellido = ?, correo = ?
        WHERE id_solicitante = ?
    ")->execute([$data['nombre'], $data['apellido'],$data['correo'], $id]);

    $db->prepare("
        UPDATE solicitantes_comunidad 
        SET direc_habita = ?, comunidad = ?
        WHERE id_solicitante = ?
    ")->execute([$data['direc_habita'], $data['comunidad'], $id]);

    $db->prepare("
        UPDATE solicitantes_info 
        SET telefono = ?
        WHERE id_solicitante = ?
    ")->execute([$data['telefono'], $id]);
}

private static function insertarSolicitante($db, $id, $data) {
    // Insertar comunidad
        $db->prepare("
            INSERT INTO solicitantes_comunidad (id_solicitante, direc_habita, comunidad)
            VALUES (?, ?, ?)
        ")->execute([$id, $data['direc_habita'], $data['comunidad']]);

        // Insertar info personal
        $db->prepare("
            INSERT INTO solicitantes_info (id_solicitante, telefono)
            VALUES (?, ?)
        ")->execute([$id, $data['telefono']]);

        // Insertar registros vacíos en las demás tablas
        $db->prepare("INSERT INTO solicitantes_conocimiento (id_solicitante) VALUES (?)")->execute([$id]);
        $db->prepare("INSERT INTO solicitantes_extra (id_solicitante) VALUES (?)")->execute([$id]);
        $db->prepare("INSERT INTO solicitantes_propiedad (id_solicitante) VALUES (?)")->execute([$id]);
        $db->prepare("INSERT INTO solicitantes_trabajo (id_solicitante) VALUES (?)")->execute([$id]);
        $db->prepare("INSERT INTO solicitantes_ingresos (id_solicitante) VALUES (?)")->execute([$id]);
}

    private static function actualizarCI($db, $ci_antiguo, $ci_nuevo) {
        // Verificar si el nuevo CI ya existe
        $stmt = $db->prepare("SELECT COUNT(*) FROM solicitantes WHERE ci = ?");
        $stmt->execute([$ci_nuevo]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("❌ No se puede actualizar la cédula: ya está registrada.");
        }

        // Actualizar en cascada
        $tablas = [
            'solicitantes',
            'despacho',
            'solicitud_ayuda',
            'solicitud_desarrollo',
            'reportes_acciones',
            'reportes_entradas'
        ];
        foreach ($tablas as $tabla) {
            $db->prepare("UPDATE $tabla SET ci = ? WHERE ci = ?")
            ->execute([$ci_nuevo, $ci_antiguo]);
        }
    }

    public static function notificacion_urgencia() {
        $conexion = DB::conectar();
        $msj = null;
        try {
            $stmt = $conexion->prepare("
                SELECT 
                    d.*, 
                    di.*,
                    df.*,
                    dco.correo_enviado,
                    dc.tipo_ayuda,
                    sol.nombre,
                    sol.correo,
                    sol.ci
                FROM despacho d
                LEFT JOIN despacho_info di ON d.id_despacho = di.id_despacho
                LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
                LEFT JOIN despacho_correo dco ON d.id_despacho = dco.id_despacho
                LEFT JOIN despacho_categoria dc ON d.id_despacho = dc.id_despacho
                LEFT JOIN solicitantes sol ON d.ci = sol.ci
                WHERE d.invalido = 0
                AND dc.tipo_ayuda IN ('Medicamentos', 'Estudios','Exámenes')
                AND df.fecha_renovacion <= DATE_SUB(NOW(), INTERVAL 5 DAY)
                ORDER BY 
                    CASE dc.tipo_ayuda
                        WHEN 'Medicamentos' THEN 0
                        WHEN 'Estudios' THEN 1
                        WHEN 'Exámenes' THEN 2
                        ELSE 2
                    END,
                    df.fecha ASC
            ");
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $fila) {
                if (!empty($fila['ci']) && $fila['correo_enviado'] == 0) {
                    $correo = $fila['correo'];
                    $nombre = $fila['nombre'];

                    $enviado = Correo::correoVencido($correo, $nombre);

                    if ($enviado) {
                        $stmtUpdate = $conexion->prepare("
                            UPDATE despacho_correo
                            SET correo_enviado = 1 
                            WHERE id_despacho = :id_despacho
                        ");
                        $stmtUpdate->execute(['id_despacho' => $fila['id_despacho']]);
                    }
                    else{
                            $msj = "Está fallando la conexión para enviar un correo de recordatorio de urgencia de la persona ".$nombre. " de cédula ".$fila['ci']."!";
                            }
                }
            }

            return [
                'exito' => true,
                'datos' => $resultados,
                'msj_correo' => $msj
            ];
        } catch (Exception $e) {
            error_log("Error al filtrar despachos por categoría y fecha: " . $e->getMessage());
            return [
                'exito' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public static function solicitud_urgencia($id_despacho) {
        try {
            $conexion = DB::conectar();

            $consulta = "SELECT 
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
                        WHERE d.id_despacho = :id_despacho";

            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':id_despacho', $id_despacho, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($datos) {
                    return [
                        'exito' => true,
                        'datos' => $datos
                    ];
                } else {
                    return [
                        'exito' => false,
                        'error' => 'No se encontró información para el despacho solicitado.'
                    ];
                }
            } else {
                return [
                    'exito' => false,
                    'error' => 'Error al ejecutar la consulta.'
                ];
            }
        } catch (PDOException $e) {
            return [
                'exito' => false,
                'error' => 'Excepción: ' . $e->getMessage()
            ];
        }
    }

  public static function buscar_filtro($filtro) {
        if (empty($filtro) || !is_string($filtro)) {
            return [
                'exito' => false,
                'error' => 'El término de búsqueda está vacío o no es válido.'
            ];
        }

        try {
            $conexion = DB::conectar();

            $consulta = "
                SELECT 
                    d.*, 
                    di.*, 
                    df.*, 
                    dc.*, 
                    sol.nombre AS nombre,
                    sol.apellido AS apellido
                FROM despacho d
                LEFT JOIN despacho_info di ON d.id_despacho = di.id_despacho
                LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
                LEFT JOIN despacho_categoria dc ON d.id_despacho = dc.id_despacho
                LEFT JOIN solicitantes sol ON d.ci = sol.ci
                WHERE 
                    d.ci LIKE :filtro OR
                    d.id_manual LIKE :filtro OR
                    d.estado LIKE :filtro OR
                    dc.categoria LIKE :filtro OR
                    di.descripcion LIKE :filtro OR
                    di.creador LIKE :filtro OR
                    CONCAT(sol.nombre, ' ', sol.apellido) LIKE :filtro OR
                    CONCAT(sol.apellido, ' ', sol.nombre) LIKE :filtro OR
                    sol.nombre LIKE :filtro OR
                    sol.apellido LIKE :filtro
            ";

            $stmt = $conexion->prepare($consulta);
            $busqueda = '%' . $filtro . '%';
            $stmt->bindParam(':filtro', $busqueda, PDO::PARAM_STR);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$datos || count($datos) === 0) {
                return [
                    'exito' => false,
                    'error' => 'No se encontraron coincidencias con el filtro proporcionado.'
                ];
            }

            return [
                'exito' => true,
                'datos' => $datos
            ];
        } catch (PDOException $e) {
            return [
                'exito' => false,
                'error' => 'Error en la base de datos: ' . $e->getMessage()
            ];
        }
    }

    public static function verificar_solicitudes($ci){
            try {
            $conexion = DB::conectar();
            $consulta = "
                SELECT 
                    d.*,
                    dc.*,
                    dco.*,
                    df.*,
                    di.*,
                    din.*,
                    sol.*
                FROM despacho d
                LEFT JOIN despacho_categoria dc ON d.id_despacho = dc.id_despacho
                LEFT JOIN despacho_correo dco ON d.id_despacho = dco.id_despacho
                LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
                LEFT JOIN despacho_info di ON d.id_despacho = di.id_despacho
                LEFT JOIN despacho_invalido din ON d.id_despacho = din.id_despacho
                LEFT JOIN solicitantes sol ON d.ci = sol.ci
                WHERE d.ci = :ci
                ORDER BY df.fecha DESC
            ";



            $cons = $conexion->prepare($consulta);
            $cons->bindParam(':ci', $ci);
            $cons->execute();
            $datos = $cons->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($datos)) {
                return [
                    'exito' => true,
                    'datos' => $datos
                ];
            } else {
                return [
                    'exito' => false
                ];
            }
        } catch (PDOException $e) {
            return [
                'exito' => false,
                'error' => 'Error al consultar solicitudes de desarrollo: ' . $e->getMessage()
            ];
        }
    }

      public static function filtrar($filtro) {
    try {
        $conexion = DB::conectar();
        $baseQuery = "
            SELECT 
                d.*, 
                df.*, 
                dc.*, 
                di.*, 
                sol.*
            FROM despacho d
            LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
            LEFT JOIN despacho_categoria dc ON d.id_despacho = dc.id_despacho
            LEFT JOIN despacho_info di ON d.id_despacho = di.id_despacho
            LEFT JOIN solicitantes sol ON d.ci = sol.ci
            WHERE d.invalido = 0
        ";

        $order = "DESC";
        $categoria = null;

        switch ($filtro) {
            case "economica":
                $categoria = "Economica";
                break;
            case "salud":
                $categoria = "Salud";
                break;
            case "materiales_construccion":
                $categoria = "Materiales de Construcción";
                break;
            case "varios":
                $categoria = "Varios";
                break;
            case "antiguos":
                $order = "ASC";
                break;
            case "recientes":
            default:
                // No se modifica categoría ni orden (DESC por defecto)
                break;
        }

        if ($categoria !== null) {
            $baseQuery .= " AND dc.categoria = :categoria";
        }

        $baseQuery .= " ORDER BY df.fecha $order";

        $stmt = $conexion->prepare($baseQuery);

        if ($categoria !== null) {
            $stmt->bindParam(':categoria', $categoria);
        }

        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'exito' => true,
            'datos' => $resultados,
            'mensaje' => 'Consulta realizada correctamente'
        ];

    } catch (PDOException $e) {
        error_log("Error al filtrar despacho: " . $e->getMessage());
        return [
            'exito' => false,
            'datos' => [],
            'mensaje' => 'Error al ejecutar la consulta: ' . $e->getMessage()
        ];
    }
}


    public static function fecha_filtro($datos) {
        $conexion = DB::conectar();
        $fecha_inicio = $datos['fecha_inicio'];
        $fecha_final = $datos['fecha_final'];
        $estado = $datos['estado'];
        try {
            $stmt = $conexion->prepare("
                  SELECT 
                        d.*, 
                        df.*, 
                        dc.*, 
                        di.*, 
                        sol.*
                    FROM despacho d
                    LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
                    LEFT JOIN despacho_categoria dc ON d.id_despacho = dc.id_despacho
                    LEFT JOIN despacho_info di ON d.id_despacho = di.id_despacho
                    LEFT JOIN solicitantes sol ON d.ci = sol.ci
                    WHERE DATE(df.fecha) >= :fecha_inicio
                    AND DATE(df.fecha) <= :fecha_final
                    AND d.estado = :estado
                    AND d.invalido = 0
                    ORDER BY df.fecha DESC
                ");

            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_final', $fecha_final);
            $stmt->bindParam(':estado', $estado);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'exito' => true,
                'datos' => $resultados
            ];
        } catch (Exception $e) {
            error_log("Error al filtrar solicitudes por fecha: " . $e->getMessage());
            return [
                'exito' => false,
                'error' => $e->getMessage()
            ];
        }
    }



}

?>