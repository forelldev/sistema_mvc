<?php 
require_once 'conexiondb.php';
require_once 'correoModelo.php';
class Desarrollo {
    public static function mostrar_lista() {
        $conexion = DB::conectar();
        $consulta = "
                    SELECT 
                        sd.id_des,
                        sd.id_manual,
                        sd.ci,
                        sd.estado,

                        sdi.descripcion,
                        sdi.creador,

                        sdt.categoria,

                        GROUP_CONCAT(sl.examen SEPARATOR ', ') AS examenes,

                        sdf.fecha,
                        sdf.fecha_modificacion,
                        sdf.visto,

                        s.nombre AS remitente_nombre,
                        s.apellido AS remitente_apellido

                    FROM solicitud_desarrollo sd
                    LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                    LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
                    LEFT JOIN solicitud_desarrollo_laboratorio sl ON sd.id_des = sl.id_des
                    LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                    LEFT JOIN solicitantes s ON sd.ci = s.ci

                    WHERE sd.invalido = 0
                    GROUP BY sd.id_des
                    ORDER BY sdf.fecha DESC
                ";


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
                'mensaje' => 'No se encontraron solicitudes válidas'
            ];
        }
    }

   public static function notificaciones() {
        $conexion = DB::conectar();
        try {
            // Estados que requieren seguimiento (excluyendo solicitudes finalizadas)
            $estadoFiltro = "
                sd.estado IN (
                    'En espera del documento físico para ser procesado 0/2',
                    'En Proceso 1/2',
                    'En Proceso 2/2 (Sin entregar)'
                )
            ";

            // Consulta principal sobre las nuevas tablas
            $stmt = $conexion->prepare("
                SELECT 
                    sd.id_des,
                    sd.id_manual,
                    sd.ci,
                    sd.estado,

                    sdf.fecha,
                    sdf.fecha_modificacion,
                    sdt.categoria,
                    sdi.nombre,
                    sdi.apellido,
                    sdi.descripcion
                FROM solicitud_desarrollo sd
                LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
                LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                WHERE sdt.categoria = 'Medicamentos'
                AND $estadoFiltro
                AND sd.invalido = 0
                AND sdf.fecha <= DATE_SUB(NOW(), INTERVAL 5 DAY)
            ");
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $fila) {
                if (!empty($fila['ci'])) {
                    $ci = $fila['ci'];

                    // Obtener correo del solicitante
                    $stmtSolicitante = $conexion->prepare("
                        SELECT nombre, correo FROM solicitantes WHERE ci = :ci
                    ");
                    $stmtSolicitante->execute(['ci' => $ci]);
                    $solicitante = $stmtSolicitante->fetch(PDO::FETCH_ASSOC);

                    if ($solicitante) {
                        $correo = $solicitante['correo'];
                        $nombre = $solicitante['nombre'];

                        // Verificar si ya se envió el correo
                        $stmtCheck = $conexion->prepare("
                            SELECT COUNT(*) FROM solicitud_desarrollo_correo 
                            WHERE id_des = :id_des AND correo_enviado = 1
                        ");
                        $stmtCheck->execute(['id_des' => $fila['id_des']]);
                        $yaEnviado = $stmtCheck->fetchColumn();

                        if ($yaEnviado == 0) {
                            $enviado = Correo::correoVencido($correo, $nombre);

                            if ($enviado) {
                                $stmtUpdate = $conexion->prepare("
                                    INSERT INTO solicitud_desarrollo_correo (id_des, correo_enviado) 
                                    VALUES (:id_des, 1)
                                ");
                                $stmtUpdate->execute(['id_des' => $fila['id_des']]);
                            }
                        }
                    }
                }
            }

            return [
                'exito' => true,
                'datos' => $resultados
            ];
        } catch (Exception $e) {
            error_log("Error al filtrar solicitudes urgentes: " . $e->getMessage());
            return [
                'exito' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public static function cargar_datos_solicitantes($ci){
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

        $patologias = self::buscarTodos($db, 'solicitantes_patologia', $id);
        $cantidad = count($patologias);
        // Buscar datos relacionados
        $datos = [
            'solicitante' => $solicitante,
            'comunidad' => self::buscarUno($db, 'solicitantes_comunidad', $id),
            'conocimiento' => self::buscarUno($db, 'solicitantes_conocimiento', $id),
            'extra' => self::buscarUno($db, 'solicitantes_extra', $id),
            'info' => self::buscarUno($db, 'solicitantes_info', $id),
            'propiedad' => self::buscarUno($db, 'solicitantes_propiedad', $id),
            'trabajo' => self::buscarUno($db, 'solicitantes_trabajo', $id),
            'ingresos' => self::buscarUno($db,'solicitantes_ingresos',$id),
            'patologia' => $patologias,
            'cantidad' => $cantidad
        ];

        return ['exito' => true, 'mostrar' => $datos];
    }

    private static function buscarUno($db, $tabla, $id) {
        $stmt = $db->prepare("SELECT * FROM $tabla WHERE id_solicitante = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private static function buscarTodos($db, $tabla, $id) {
        $stmt = $db->prepare("SELECT * FROM $tabla WHERE id_solicitante = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function enviar_formulario($data) {
    $db = DB::conectar();
    $db->beginTransaction();

    try {
        // Verificar si el número de documento ya existe
        $stmt = $db->prepare("SELECT COUNT(*) FROM solicitud_desarrollo WHERE id_manual = :id_manual");
        $stmt->execute([':id_manual' => $data['id_manual']]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("❌ El número de documento ya está registrado.");
        }

        // Validar campos obligatorios
        $camposObligatorios = [
            'id_manual', 'ci', 'descripcion', 'fecha', 'categoria', 'ci_user',
            'nombre', 'apellido', 'correo', 'telefono', 'direc_habita', 'comunidad'
        ];
        foreach ($camposObligatorios as $campo) {
            if (!isset($data[$campo]) || trim($data[$campo]) === '') {
                throw new Exception("Falta el campo obligatorio: $campo");
            }
        }

        // Obtener nombre del promotor
        $stmt = $db->prepare("SELECT nombre, apellido FROM usuarios_info WHERE ci = :ci");
        $stmt->execute([':ci' => $data['ci_user']]);
        $promotor = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$promotor) {
            throw new Exception("No se encontró el promotor con CI: " . $data['ci_user']);
        }
        $nombrePromotor = $promotor['nombre'] . ' ' . $promotor['apellido'];

        // Insertar solicitud base
        $stmt = $db->prepare("INSERT INTO solicitud_desarrollo (id_manual, ci, estado, invalido) VALUES (:id_manual, :ci, :estado, :invalido)");
        $stmt->execute([
            ':id_manual' => $data['id_manual'],
            ':ci' => $data['ci'],
            ':estado' => 'En espera del documento físico para ser procesado 0/2',
            ':invalido' => 0
        ]);
        $id_des = $db->lastInsertId();

        // Insertar descripción y creador
        $stmt = $db->prepare("INSERT INTO solicitud_desarrollo_info (id_des, descripcion, creador) VALUES (:id_des, :descripcion, :creador)");
        $stmt->execute([
            ':id_des' => $id_des,
            ':descripcion' => $data['descripcion'],
            ':creador' => $nombrePromotor
        ]);

        // Insertar categoría
        $stmt = $db->prepare("INSERT INTO solicitud_desarrollo_tipo (id_des, categoria) VALUES (:id_des, :categoria)");
        $stmt->execute([
            ':id_des' => $id_des,
            ':categoria' => $data['categoria']
        ]);

        // Insertar exámenes si aplica
        if ($data['categoria'] === 'Laboratorio' && !empty($data['examen'])) {
            // Inserta exámenes de laboratorio
            $examenes = is_array($data['examen']) ? $data['examen'] : [$data['examen']];
            $stmt = $db->prepare("INSERT INTO solicitud_desarrollo_laboratorio (id_des, examen) VALUES (:id_des, :examen)");
            foreach ($examenes as $examen) {
                $stmt->execute([':id_des' => $id_des, ':examen' => $examen]);
            }

        } elseif (in_array($data['categoria'], ['Ecosonograma', 'Eco-Doppler'])) {
            // Inserta ecosonograma o eco-doppler
            $stmt = $db->prepare("INSERT INTO solicitud_desarrollo_laboratorio (id_des, examen) VALUES (:id_des, :examen)");
            $stmt->execute([':id_des' => $id_des, ':examen' => $data['categoria']]);

        } elseif ($data['categoria'] === 'Medicamentos' && !empty($data['examen'])) {
            // Inserta medicamentos (usa examen[] para capturar el nombre del medicamento)
            $medicamentos = is_array($data['examen']) ? $data['examen'] : [$data['examen']];
            $stmt = $db->prepare("INSERT INTO solicitud_desarrollo_laboratorio (id_des, examen) VALUES (:id_des, :examen)");
            foreach ($medicamentos as $medicamento) {
                $medicamento = ucfirst($medicamento);
                $stmt->execute([':id_des' => $id_des, ':examen' => $medicamento]);
            }
        }

        // Insertar fechas
        $stmt = $db->prepare("INSERT INTO solicitud_desarrollo_fecha (id_des, fecha, fecha_modificacion, fecha_renovacion, visto) VALUES (:id_des, :fecha, :fecha_modificacion, :fecha_renovacion, :visto)");
        $stmt->execute([
            ':id_des' => $id_des,
            ':fecha' => $data['fecha'],
            ':fecha_modificacion' => $data['fecha'],
            ':fecha_renovacion' => $data['fecha'],
            ':visto' => 0
        ]);

        // Estado de correo
        $stmt = $db->prepare("INSERT INTO solicitud_desarrollo_correo (id_des, correo_enviado) VALUES (:id_des, :correo_enviado)");
        $stmt->execute([
            ':id_des' => $id_des,
            ':correo_enviado' => 0
        ]);

        // Manejo del solicitante
        $mensaje_nuevo = null;
        $id_solicitante = $data['id_solicitante'] ?? null;

        if ($id_solicitante) {
            self::actualizarSolicitante($db, $id_solicitante, $data);
        } else {
            $stmt = $db->prepare("SELECT id_solicitante FROM solicitantes WHERE ci = ?");
            $stmt->execute([$data['ci']]);
            $id_solicitante = $stmt->fetchColumn();

            if ($id_solicitante) {
                self::actualizarSolicitante($db, $id_solicitante, $data);
            } else {
                $stmt = $db->prepare("INSERT INTO solicitantes (ci, nombre, apellido, correo, fecha_creacion) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$data['ci'], $data['nombre'], $data['apellido'], $data['correo'], $data['fecha']]);
                $id_solicitante = $db->lastInsertId();

                self::insertarSolicitante($db, $id_solicitante, $data);
                $mensaje_nuevo = "Se ha registrado un nuevo beneficiario.";
            }
        }

        $db->commit();
        return ['exito' => true, 'id_des' => $id_des, 'mensaje_nuevo' => $mensaje_nuevo];

    } catch (Exception $e) {
        $db->rollBack();
        error_log("Error al registrar solicitud de desarrollo: " . $e->getMessage());
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


    private static function obtenerNombreCreador($ci_user) {
        $db = DB::conectar();
        $stmt = $db->prepare("SELECT nombre, apellido FROM usuarios_info WHERE ci = :ci");
        $stmt->execute([':ci' => $ci_user]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            return $usuario['nombre'] . ' ' . $usuario['apellido'];
        } else {
            return 'Desconocido';
        }
    }

    public static function verificar_solicitudes($ci) {
    try {
        $conexion = DB::conectar();
        $consulta = "
                SELECT 
                    sd.id_des,
                    sd.id_manual,
                    sd.ci,
                    sd.estado,
                    sd.invalido,

                    sdi.descripcion,
                    sdi.creador,
                    sdt.categoria,
                    GROUP_CONCAT(sl.examen SEPARATOR ', ') AS examenes,
                    sdf.fecha,
                    sdf.fecha_modificacion,
                    sdf.visto,

                    sol.nombre AS remitente_nombre,
                    sol.apellido AS remitente_apellido

                FROM solicitud_desarrollo sd
                LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
                LEFT JOIN solicitud_desarrollo_laboratorio sl ON sd.id_des = sl.id_des
                LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                LEFT JOIN solicitantes sol ON sd.ci = sol.ci

                WHERE sd.ci = :ci
                GROUP BY sd.id_des
                ORDER BY sdf.fecha DESC
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

    public static function mostrar_inhabilitados() {
        try {
            $conexion = DB::conectar();
            $consulta = "
                SELECT 
                    sd.id_des,
                    sd.id_manual,
                    sd.ci,
                    sd.estado,
                    sd.invalido,

                    sdi.descripcion,
                    sdi.creador,
                    sdt.categoria,
                    GROUP_CONCAT(sl.examen SEPARATOR ', ') AS examenes,
                    sdf.fecha,
                    sdf.fecha_modificacion,
                    sdf.visto,

                    sdi2.razon AS razon_invalidez,
                    sol.nombre AS remitente_nombre,
                    sol.apellido AS remitente_apellido

                FROM solicitud_desarrollo sd
                LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
                LEFT JOIN solicitud_desarrollo_laboratorio sl ON sd.id_des = sl.id_des
                LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                LEFT JOIN solicitud_desarrollo_invalido sdi2 ON sd.id_des = sdi2.id_des
                LEFT JOIN solicitantes sol ON sd.ci = sol.ci

                WHERE sd.invalido = 1
                GROUP BY sd.id_des
                ORDER BY sdf.fecha DESC
            ";

            $stmt = $conexion->prepare($consulta);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($resultado) {
                return [
                    'exito' => true,
                    'datos' => $resultado
                ];
            } else {
                return [
                    'exito' => false,
                    'mensaje' => 'No se encontraron solicitudes inhabilitadas'
                ];
            }
        } catch (PDOException $e) {
            return [
                'exito' => false,
                'error' => 'Error al consultar solicitudes inhabilitadas: ' . $e->getMessage()
            ];
        }
    }

    public static function edicion_vista($id_des) {
        $conexion = DB::conectar();

        try {
            $stmt = $conexion->prepare("
                SELECT 
                    sd.*, 
                    sdf.fecha, sdf.fecha_modificacion, sdf.visto,
                    sdc.correo_enviado,
                    sdt.categoria,
                    sdi.descripcion, sdi.creador,
                    GROUP_CONCAT(sl.examen SEPARATOR ', ') AS examenes,
                    sdinv.razon AS razon_invalidez
                FROM solicitud_desarrollo sd
                LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                LEFT JOIN solicitud_desarrollo_correo sdc ON sd.id_des = sdc.id_des
                LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
                LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                LEFT JOIN solicitud_desarrollo_laboratorio sl ON sd.id_des = sl.id_des
                LEFT JOIN solicitud_desarrollo_invalido sdinv ON sd.id_des = sdinv.id_des
                WHERE sd.id_des = ?
                GROUP BY sd.id_des
            ");
            $stmt->execute([$id_des]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return [
                    'exito' => true,
                    'datos' => $resultado
                ];
            } else {
                return [
                    'exito' => false,
                    'error' => 'No se encontró la solicitud.'
                ];
            }
        } catch (PDOException $e) {
            error_log("Error al obtener solicitud de desarrollo: " . $e->getMessage());
            return [
                'exito' => false,
                'error' => $e->getMessage()
            ];
        }
    }


  public static function editar($data) {
    $conexion = DB::conectar();

    try {
        $conexion->beginTransaction();

        $camposObligatorios = [
            'id_des', 'id_manual', 'descripcion', 'categoria'
        ];

        foreach ($camposObligatorios as $campo) {
            if (!isset($data[$campo]) || $data[$campo] === '') {
                throw new Exception("Falta el campo obligatorio: $campo");
            }
        }

        // Obtener el id_manual actual para este id_des
        $actual = $conexion->prepare("
            SELECT id_manual FROM solicitud_desarrollo WHERE id_des = ?
        ");
        $actual->execute([$data['id_des']]);
        $idManualActual = $actual->fetchColumn();

        // Si el id_manual ha cambiado, verificar disponibilidad
        if ($idManualActual !== $data['id_manual']) {
            $verificar = $conexion->prepare("
                SELECT COUNT(*) FROM solicitud_desarrollo 
                WHERE id_manual = ? AND id_des != ?
            ");
            $verificar->execute([$data['id_manual'], $data['id_des']]);
            $existe = $verificar->fetchColumn();

            if ($existe > 0) {
                $conexion->rollBack();
                return ['exito' => false, 'error' => 'El ID manual ya está asignado a otra solicitud.'];
            }

            $stmt1 = $conexion->prepare("
                UPDATE solicitud_desarrollo 
                SET id_manual = ? 
                WHERE id_des = ?
            ");
            $stmt1->execute([
                $data['id_manual'],
                $data['id_des']
            ]);
        }

        // Actualizar solicitud_desarrollo_info
        $stmt2 = $conexion->prepare("
            UPDATE solicitud_desarrollo_info 
            SET descripcion = ?
            WHERE id_des = ?
        ");
        $stmt2->execute([
            $data['descripcion'],
            $data['id_des']
        ]);

        // Actualizar solicitud_desarrollo_tipo
        $stmt3 = $conexion->prepare("
            UPDATE solicitud_desarrollo_tipo 
            SET categoria = ? 
            WHERE id_des = ?
        ");
        $stmt3->execute([
            $data['categoria'],
            $data['id_des']
        ]);

        // Manejo de exámenes según categoría y subcategoría
        $stmtDel = $conexion->prepare("
            DELETE FROM solicitud_desarrollo_laboratorio WHERE id_des = ?
        ");
        $stmtDel->execute([$data['id_des']]);

        if ($data['categoria'] === 'Laboratorio') {
            $subcategoria = $data['subcategoria'] ?? '';

            if ($subcategoria === 'Exámenes de Laboratorio') {
                if (!empty($data['examen']) && is_array($data['examen'])) {
                    $stmtIns = $conexion->prepare("
                        INSERT INTO solicitud_desarrollo_laboratorio (id_des, examen) VALUES (?, ?)
                    ");
                    foreach ($data['examen'] as $examen) {
                        $stmtIns->execute([$data['id_des'], $examen]);
                    }
                }
            } elseif ($subcategoria === 'Eco-Doppler' || $subcategoria === 'Ecosonograma') {
                $stmtIns = $conexion->prepare("
                    INSERT INTO solicitud_desarrollo_laboratorio (id_des, examen) VALUES (?, ?)
                ");
                $stmtIns->execute([$data['id_des'], $subcategoria]);
            }
        }

        // Actualizar fecha_modificacion
        $stmt4 = $conexion->prepare("
            UPDATE solicitud_desarrollo_fecha 
            SET fecha_modificacion = NOW() 
            WHERE id_des = ?
        ");
        $stmt4->execute([$data['id_des']]);

        $conexion->commit();
        return ['exito' => true];

    } catch (Exception $e) {
        if ($conexion->inTransaction()) {
            $conexion->rollBack();
        }
        error_log("Error al editar solicitud de desarrollo: " . $e->getMessage());
        return ['exito' => false, 'error' => $e->getMessage()];
    }
}



    public static function filtrar($filtro){
        try {
            $conexion = DB::conectar();

            $baseQuery = "
                SELECT 
                    sd.*, 
                    sdf.fecha, sdf.fecha_modificacion, sdf.visto,
                    sdc.correo_enviado,
                    sdt.categoria,
                    sdi.descripcion, sdi.creador,
                    sdl.examen,
                    sol.nombre AS remitente_nombre,
                    sol.apellido AS remitente_apellido
                FROM solicitud_desarrollo sd
                LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                LEFT JOIN solicitud_desarrollo_correo sdc ON sd.id_des = sdc.id_des
                LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
                LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                LEFT JOIN solicitud_desarrollo_laboratorio sdl ON sd.id_des = sdl.id_des
                LEFT JOIN solicitantes sol ON sd.ci = sol.ci
                WHERE sd.invalido = 0
            ";

            $order = "DESC";
            $categoria = null;

            switch ($filtro) {
                case "economica":
                    $categoria = "Economica";
                    break;
                case "otros":
                    $categoria = "Otros";
                    break;
                case "medicinas":
                    $categoria = "Medicamentos";
                    break;
                case "laboratorio":
                    $categoria = "Laboratorio";
                    break;
                case "ayuda_tecnica":
                    $categoria = "Ayudas Técnicas";
                    break;
                case "enseres":
                    $categoria = "Enseres";
                    break;
                case "urgentes":
                    $categoria = "Urgentes";
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
                $baseQuery .= " AND sdt.categoria = :categoria";
            }

            $baseQuery .= " ORDER BY sdf.fecha $order";

            $stmt = $conexion->prepare($baseQuery);

            if ($categoria !== null) {
                $stmt->bindParam(':categoria', $categoria);
            }

            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return ['exito' => true, 'datos' => $resultados];

        } catch (PDOException $e) {
            error_log("Error al filtrar solicitud_desarrollo: " . $e->getMessage());
            return [];
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
                        sd.id_des,
                        sd.id_manual,
                        sd.ci,
                        sd.estado,
                        sdi.descripcion,
                        sdi.creador,
                        sdt.categoria,
                        GROUP_CONCAT(sdl.examen SEPARATOR ', ') AS examenes,
                        MAX(sdf.fecha) AS fecha,
                        MAX(sdf.fecha_modificacion) AS fecha_modificacion,
                        MAX(sdf.visto) AS visto,
                        sdc.correo_enviado,
                        sol.nombre AS remitente_nombre,
                        sol.apellido AS remitente_apellido
                    FROM solicitud_desarrollo sd
                    LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                    LEFT JOIN solicitud_desarrollo_correo sdc ON sd.id_des = sdc.id_des
                    LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
                    LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                    LEFT JOIN solicitud_desarrollo_laboratorio sdl ON sd.id_des = sdl.id_des
                    LEFT JOIN solicitantes sol ON sd.ci = sol.ci
                    WHERE DATE(sdf.fecha) >= :fecha_inicio
                    AND DATE(sdf.fecha) <= :fecha_final 
                    AND sd.estado = :estado
                    AND sd.invalido = 0
                    GROUP BY sd.id_des
                    ORDER BY fecha DESC;
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

   public static function notificacion_urgencia() {
            $conexion = DB::conectar();
            $msj = null;

            try {
                $stmt = $conexion->prepare("
                    SELECT 
                        sd.*, 
                        sdf.*,
                        sdc.correo_enviado,
                        sdt.categoria,
                        sdi.*
                    FROM solicitud_desarrollo sd
                    LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                    LEFT JOIN solicitud_desarrollo_correo sdc ON sd.id_des = sdc.id_des
                    LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
                    LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                    WHERE sdt.categoria IN ('Medicamentos', 'Laboratorio')
                    AND sd.estado != 'Solicitud Finalizada (Ayuda Entregada)'
                    AND sd.invalido = 0
                    AND sdf.fecha_renovacion <= DATE_SUB(NOW(), INTERVAL 5 DAY)
                    ORDER BY 
                        CASE sdt.categoria
                            WHEN 'Medicamentos' THEN 0
                            WHEN 'Laboratorio' THEN 1
                            ELSE 2
                        END,
                        sdf.fecha ASC
                ");
                $stmt->execute();
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultados as $fila) {
                    if (!empty($fila['ci']) && $fila['correo_enviado'] == 0) {
                        $ci = $fila['ci'];
                        $stmtSolicitante = $conexion->prepare("
                            SELECT nombre, correo FROM solicitantes WHERE ci = :ci
                        ");
                        $stmtSolicitante->execute(['ci' => $ci]);
                        $solicitante = $stmtSolicitante->fetch(PDO::FETCH_ASSOC);

                        if ($solicitante) {
                            $correo = $solicitante['correo'];
                            $nombre = $solicitante['nombre'];

                            $enviado = Correo::correoVencido($correo, $nombre);

                            if ($enviado) {
                                $stmtUpdate = $conexion->prepare("
                                    UPDATE solicitud_desarrollo_correo 
                                    SET correo_enviado = 1 
                                    WHERE id_des = :id_des
                                ");
                                $stmtUpdate->execute(['id_des' => $fila['id_des']]);
                            } else {
                                $msj = "Está fallando la conexión para enviar un correo de recordatorio de urgencia de la persona $nombre de cédula $ci!";
                            }
                        }
                    }
                }

                return [
                    'exito' => true,
                    'datos' => $resultados,
                    'msj_correo' => $msj
                ];
            } catch (Exception $e) {
                error_log("Error al filtrar solicitudes por categoría y fecha: " . $e->getMessage());
                return [
                    'exito' => false,
                    'error' => $e->getMessage(),
                    'msj_correo' => $msj
                ];
            }
        }

      public static function mostrar_urgencia($id_des){
            try {
                $conexion = DB::conectar();

                $sql = "
                    SELECT 
                        sd.*,
                        sdi.*,
                        sdt.*,
                        GROUP_CONCAT(sl.examen SEPARATOR ', ') AS examenes,
                        sdf.*,
                        s.nombre AS nombre,
                        s.apellido AS apellido
                    FROM solicitud_desarrollo sd
                    LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                    LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
                    LEFT JOIN solicitud_desarrollo_laboratorio sl ON sd.id_des = sl.id_des
                    LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                    LEFT JOIN solicitantes s ON sd.ci = s.ci
                    WHERE sd.id_des = :id_des
                    GROUP BY sd.id_des
                ";

                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':id_des', $id_des);
                $stmt->execute();
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return [
                    'exito' => true,
                    'datos' => $resultados
                ];
            } catch (Exception $e) {
                error_log("Error al mostrar la solicitud urgente: " . $e->getMessage());
                return [
                    'exito' => false,
                    'error' => $e->getMessage()
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
                    sd.*, 
                    sdf.*, 
                    sdc.correo_enviado, 
                    sdt.*, 
                    sdi.*, 
                    sol.nombre AS remitente_nombre,
                    sol.apellido AS remitente_apellido,
                    lab.examenes
                FROM solicitud_desarrollo sd
                LEFT JOIN solicitud_desarrollo_fecha sdf ON sd.id_des = sdf.id_des
                LEFT JOIN solicitud_desarrollo_correo sdc ON sd.id_des = sdc.id_des
                LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
                LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
                LEFT JOIN solicitantes sol ON sd.ci = sol.ci
                LEFT JOIN (
                    SELECT id_des, GROUP_CONCAT(examen SEPARATOR ', ') AS examenes
                    FROM solicitud_desarrollo_laboratorio
                    GROUP BY id_des
                ) AS lab ON lab.id_des = sd.id_des
                WHERE (
                    sd.ci LIKE :filtro OR
                    sd.id_manual LIKE :filtro OR
                    sd.estado LIKE :filtro OR
                    sdt.categoria LIKE :filtro OR
                    lab.examenes LIKE :filtro OR
                    sdi.descripcion LIKE :filtro OR
                    sdi.creador LIKE :filtro OR
                    CONCAT(sol.nombre, ' ', sol.apellido) LIKE :filtro OR
                    CONCAT(sol.apellido, ' ', sol.nombre) LIKE :filtro OR
                    sol.nombre LIKE :filtro OR
                    sol.apellido LIKE :filtro
                    )
                    AND sd.invalido = 0
                    GROUP BY sd.id_des
                    ORDER BY sd.id_des DESC
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



}





?>