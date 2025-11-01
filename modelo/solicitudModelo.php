<?php 
require_once 'conexiondb.php';
require_once 'correoModelo.php';
class Solicitud{
    // MOSTRAR LISTA DE SOLICITUDES DE AYUDA:
    public static function buscarLista() {
        $conexion = DB::conectar();
        $estados = [];
        switch ($_SESSION['id_rol']) {
            case 1:
                $estados = ['En espera del documento físico para ser procesado 0/3', 'En Proceso 1/3'];
                break;
            case 2:
                $estados = ['En Proceso 2/3'];
                break;
            case 3:
                $estados = ['En Proceso 3/3 (Sin entregar)','Solicitud Finalizada (Ayuda entregada)'];
                break;
            default:
                $estados = ['En espera del documento físico para ser procesado 0/3', 'En Proceso 1/3', 'En Proceso 2/3', 'En Proceso 3/3 (Sin entregar)', 'Solicitud Finalizada (Ayuda entregada)'];
                break;
        }
        // Construir placeholders dinámicos
        $placeholders = implode(',', array_fill(0, count($estados), '?'));
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
                INNER JOIN solicitud_ayuda_fecha saf ON sa.id_doc = saf.id_doc
                LEFT JOIN solicitud_ayuda_correo sc ON sa.id_doc = sc.id_doc
                LEFT JOIN solicitud_categoria cat ON sa.id_doc = cat.id_doc
                LEFT JOIN solicitud_descripcion des ON sa.id_doc = des.id_doc
                LEFT JOIN solicitantes sol ON sa.ci = sol.ci
                WHERE sa.estado IN ($placeholders)
                AND sa.invalido != 1
                ORDER BY saf.fecha DESC
            ";

        $busqueda = $conexion->prepare($consulta);
        $busqueda->execute($estados); // Pasar los valores como parámetros
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

    // PROCESAR FORMULARIO UNA VEZ ENVIADO:
   public static function enviarForm($data) {
    $db = DB::conectar();
    $db->beginTransaction();
    try {
        // Verificar si el id_manual ya existe
        $checkStmt = $db->prepare("SELECT COUNT(*) FROM solicitud_ayuda WHERE id_manual = :id_manual");
        $checkStmt->execute([':id_manual' => $data['id_manual']]);
        if ($checkStmt->fetchColumn() > 0) {
            throw new Exception("❌ El número de documento ya está registrado.");
        }

        self::normalizarCamposTrabajo($data);

        if (empty($data['tipo_ayuda']) && !empty($data['categoria'])) {
            $data['tipo_ayuda'] = $data['categoria'];
        }

        // Validar campos obligatorios
        $camposObligatorios = [
            'id_manual', 'ci', 'descripcion', 'fecha',
            'categoria', 'tipo_ayuda', 'ci_user',
            'nombre', 'apellido', 'correo', 'fecha_nacimiento', 'lugar_nacimiento',
            'estado_civil', 'telefono', 'codigo_patria', 'serial_patria',
            'comunidad', 'direc_habita', 'estruc_base', 'profesion', 'nivel_instruc',
            'propiedad', 'propiedad_est', 'trabajo', 'nombre_insti',
            'nivel_ingreso', 'pension', 'bono'
        ];
        foreach ($camposObligatorios as $campo) {
            if (!isset($data[$campo]) || $data[$campo] === '') {
                throw new Exception("Falta el campo obligatorio: $campo");
            }
        }

        // Capitalizar campos
        $campos = ['nombre', 'apellido', 'lugar_nacimiento', 'profesion', 'trabajo', 'direccion_trabajo', 'nombre_insti', 'direc_habita', 'estruc_base', 'descripcion'];
        foreach ($campos as $campo) {
            if (isset($data[$campo])) {
                $data[$campo] = ucfirst($data[$campo]);
            }
        }

        $data['observaciones'] = !empty($data['observaciones']) ? ucfirst($data['observaciones']) : 'Sin observaciones';
        $data['observaciones_propiedad'] = !empty($data['observaciones_propiedad']) ? ucfirst($data['observaciones_propiedad']) : 'Sin observaciones';


        if (!empty($data['patologias']) && is_array($data['patologias'])) {
            foreach ($data['patologias'] as $i => $patologia) {
                if (!empty($patologia['nom_patologia']) && is_string($patologia['nom_patologia'])) {
                    $data['patologias'][$i]['nom_patologia'] = ucfirst($patologia['nom_patologia']);
                }
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

        // Insertar solicitud_ayuda
        $stmt = $db->prepare("INSERT INTO solicitud_ayuda (id_manual, ci, estado) VALUES (:id_manual, :ci, :estado)");
        $stmt->execute([
            ':id_manual' => $data['id_manual'],
            ':ci' => $data['ci'],
            ':estado' => 'En espera del documento físico para ser procesado 0/3'
        ]);
        $id_doc = $db->lastInsertId();

        // solicitud_ayuda_correo
        $stmt = $db->prepare("INSERT INTO solicitud_ayuda_correo (id_doc, correo_enviado) VALUES (:id_doc, :correo_enviado)");
        $stmt->execute([
            ':id_doc' => $id_doc,
            ':correo_enviado' => 0
        ]);

        // solicitud_categoria
        $stmt = $db->prepare("INSERT INTO solicitud_categoria (id_doc, tipo_ayuda, categoria) VALUES (:id_doc, :tipo_ayuda, :categoria)");
        $stmt->execute([
            ':id_doc' => $id_doc,
            ':tipo_ayuda' => $data['tipo_ayuda'],
            ':categoria' => $data['categoria']
        ]);

        // solicitud_descripcion
        $stmt = $db->prepare("INSERT INTO solicitud_descripcion (id_doc, descripcion, promotor, observaciones) VALUES (:id_doc, :descripcion, :promotor, :observaciones)");
        $stmt->execute([
            ':id_doc' => $id_doc,
            ':descripcion' => $data['descripcion'],
            ':promotor' => $nombrePromotor,
            ':observaciones' => $data['observaciones']
        ]);

        // ❌ ERROR ORIGINAL: faltaba coma entre :fecha_renovacion y :visto
        $stmt = $db->prepare("INSERT INTO solicitud_ayuda_fecha (id_doc, fecha, fecha_modificacion, fecha_renovacion, visto) VALUES (:id_doc, :fecha, :fecha_modificacion, :fecha_renovacion, :visto)");
        $stmt->execute([
            ':id_doc' => $id_doc,
            ':fecha' => $data['fecha'],
            ':fecha_modificacion' => $data['fecha'],
            ':fecha_renovacion' => $data['fecha'],
            ':visto' => 0
        ]);

        // Verificar si el solicitante ya existe
        $stmt = $db->prepare("SELECT id_solicitante FROM solicitantes WHERE ci = :ci");
        $stmt->execute([':ci' => $data['ci']]);
        $solicitante = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($solicitante) {
            $id_solicitante = $solicitante['id_solicitante'];
            self::actualizarSolicitante($db, $id_solicitante, $data);
        } else {
            $stmt = $db->prepare("INSERT INTO solicitantes (nombre, apellido, ci, correo, fecha_creacion) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$data['nombre'], $data['apellido'], $data['ci'], $data['correo'], $data['fecha']]);
            $id_solicitante = $db->lastInsertId();
            self::insertarSolicitante($db, $id_solicitante, $data);
        }

        $db->commit();
        return ['exito' => true, 'id_doc' => $id_doc];

    } catch (Exception $e) {
            $db->rollBack();

            // Captura información detallada del error
            $errorInfo = $e instanceof PDOException ? $e->errorInfo : null;
            $mensaje = $e->getMessage();
            $codigo = $e->getCode();
            $archivo = $e->getFile();
            $linea = $e->getLine();

            // Log detallado
            error_log("⛔ ERROR PDO:");
            error_log("Mensaje: $mensaje");
            error_log("Código: $codigo");
            error_log("Archivo: $archivo");
            error_log("Línea: $linea");
            if ($errorInfo) {
                error_log("SQLSTATE: " . ($errorInfo[0] ?? ''));
                error_log("Driver error: " . ($errorInfo[1] ?? ''));
                error_log("Descripción: " . ($errorInfo[2] ?? ''));
            }

            return [
                'exito' => false,
                'error' => "$mensaje"
            ];
        }

    }

    private static function normalizarCamposTrabajo(&$data) {
        $data['trabajo'] = isset($data['trabajo']) && trim($data['trabajo']) !== '' ? $data['trabajo'] : 'No tiene';
        $data['direccion_trabajo'] = isset($data['direccion_trabajo']) && trim($data['direccion_trabajo']) !== '' ? $data['direccion_trabajo'] : 'No';
        $data['trabaja_public'] = isset($data['trabaja_public']) && trim($data['trabaja_public']) !== '' ? $data['trabaja_public'] : 'No';
        $data['nombre_insti'] = isset($data['nombre_insti']) && trim($data['nombre_insti']) !== '' ? $data['nombre_insti'] : 'No';
    }


    private static function actualizarSolicitante($db, $id, $data) {
    // Actualizar solicitante
    $db->prepare("
        UPDATE solicitantes
        SET nombre = ?, apellido = ?
        WHERE id_solicitante = ?
    ")->execute([$data['nombre'], $data['apellido'], $id]);

    // Actualizar comunidad
    $db->prepare("
        UPDATE solicitantes_comunidad 
        SET comunidad = ?, direc_habita = ?, estruc_base = ?
        WHERE id_solicitante = ?
    ")->execute([$data['comunidad'], $data['direc_habita'], $data['estruc_base'], $id]);

    // Actualizar conocimiento
    $db->prepare("
        UPDATE solicitantes_conocimiento 
        SET profesion = ?, nivel_instruc = ?
        WHERE id_solicitante = ?
    ")->execute([$data['profesion'], $data['nivel_instruc'], $id]);

    // Actualizar patria
    $db->prepare("
        UPDATE solicitantes_extra 
        SET codigo_patria = ?, serial_patria = ?
        WHERE id_solicitante = ?
    ")->execute([$data['codigo_patria'], $data['serial_patria'], $id]);

    // Actualizar info personal
    $db->prepare("
        UPDATE solicitantes_info 
        SET fecha_nacimiento = ?, lugar_nacimiento = ?, estado_civil = ?, telefono = ?
        WHERE id_solicitante = ?
    ")->execute([
        $data['fecha_nacimiento'],
        $data['lugar_nacimiento'],
        $data['estado_civil'],
        $data['telefono'],
        $id
    ]);

    // Actualizar propiedad
    $db->prepare("
        UPDATE solicitantes_propiedad 
        SET propiedad = ?, propiedad_est = ?, observaciones_propiedad = ?
        WHERE id_solicitante = ?
    ")->execute([
        $data['propiedad'],
        $data['propiedad_est'],
        $data['observaciones_propiedad'],
        $id
    ]);

    // Actualizar trabajo
    $db->prepare("
        UPDATE solicitantes_trabajo 
        SET trabajo = ?, direccion_trabajo = ?, trabaja_public = ?, nombre_insti = ?
        WHERE id_solicitante = ?
    ")->execute([
        $data['trabajo'],
        $data['direccion_trabajo'],
        $data['trabaja_public'],
        $data['nombre_insti'],
        $id
    ]);

    // Actualizar ingresos
    $db->prepare("
        UPDATE solicitantes_ingresos 
        SET nivel_ingreso = ?, pension = ?, bono = ?
        WHERE id_solicitante = ?
    ")->execute([
        $data['nivel_ingreso'],
        $data['pension'],
        $data['bono'],
        $id
    ]);

    // Actualizar patologías
    $db->prepare("DELETE FROM solicitantes_patologia WHERE id_solicitante = ?")
        ->execute([$id]);

    $tipos = $data['tip_patologia'] ?? [];
    $nombres = $data['nom_patologia'] ?? [];

    if (!is_array($tipos)) $tipos = [$tipos];
    if (!is_array($nombres)) $nombres = [$nombres];

    $esSinPatologia = count($tipos) === 1 && strtolower(trim($tipos[0])) === 'no';

    if (!$esSinPatologia) {
        $total = min(count($tipos), count($nombres));
        for ($i = 0; $i < $total; $i++) {
            $tipo = trim($tipos[$i]);
            $nombre = trim($nombres[$i] ?? '');
            if ($tipo !== '' && $nombre !== '') {
                $db->prepare("
                    INSERT INTO solicitantes_patologia (id_solicitante, tip_patologia, nom_patologia)
                    VALUES (?, ?, ?)
                ")->execute([$id, $tipo, ucfirst($nombre)]);
            }
        }
    }
}


private static function insertarSolicitante($db, $id, $data) {
    // Insertar comunidad
    $db->prepare("
        INSERT INTO solicitantes_comunidad (id_solicitante, comunidad, direc_habita, estruc_base)
        VALUES (?, ?, ?, ?)
    ")->execute([$id, $data['comunidad'], $data['direc_habita'], $data['estruc_base']]);

    // Insertar conocimiento
    $db->prepare("
        INSERT INTO solicitantes_conocimiento (id_solicitante, profesion, nivel_instruc)
        VALUES (?, ?, ?)
    ")->execute([$id, $data['profesion'], $data['nivel_instruc']]);

    // Insertar patria
    $db->prepare("
        INSERT INTO solicitantes_extra (id_solicitante, codigo_patria, serial_patria)
        VALUES (?, ?, ?)
    ")->execute([$id, $data['codigo_patria'], $data['serial_patria']]);

    // Insertar info personal
    $db->prepare("
        INSERT INTO solicitantes_info (id_solicitante, fecha_nacimiento, lugar_nacimiento, estado_civil, telefono)
        VALUES (?, ?, ?, ?, ?)
    ")->execute([
        $id,
        $data['fecha_nacimiento'],
        $data['lugar_nacimiento'],
        $data['estado_civil'],
        $data['telefono']
    ]);

    // Insertar propiedad
    $db->prepare("
        INSERT INTO solicitantes_propiedad (id_solicitante, propiedad, propiedad_est, observaciones_propiedad)
        VALUES (?, ?, ?, ?)
    ")->execute([
        $id,
        $data['propiedad'],
        $data['propiedad_est'],
        $data['observaciones_propiedad']
    ]);

    // Insertar trabajo
    $db->prepare("
        INSERT INTO solicitantes_trabajo (id_solicitante, trabajo, direccion_trabajo, trabaja_public, nombre_insti)
        VALUES (?, ?, ?, ?, ?)
    ")->execute([
        $id,
        $data['trabajo'],
        $data['direccion_trabajo'],
        $data['trabaja_public'],
        $data['nombre_insti']
    ]);

    // Insertar ingresos
    $db->prepare("
        INSERT INTO solicitantes_ingresos (id_solicitante, nivel_ingreso, pension, bono)
        VALUES (?, ?, ?, ?)
    ")->execute([
        $id,
        $data['nivel_ingreso'],
        $data['pension'],
        $data['bono']
    ]);

    // Insertar patologías
    $tipos = $data['tip_patologia'] ?? [];
    $nombres = $data['nom_patologia'] ?? [];

    if (!is_array($tipos)) $tipos = [$tipos];
    if (!is_array($nombres)) $nombres = [$nombres];

    $esSinPatologia = count($tipos) === 1 && strtolower(trim($tipos[0])) === 'no';

    if (!$esSinPatologia) {
        $total = min(count($tipos), count($nombres));
        for ($i = 0; $i < $total; $i++) {
            $tipo = trim($tipos[$i]);
            $nombre = trim($nombres[$i] ?? '');
            if ($tipo !== '' && $nombre !== '') {
                $db->prepare("
                    INSERT INTO solicitantes_patologia (id_solicitante, tip_patologia, nom_patologia)
                    VALUES (?, ?, ?)
                ")->execute([$id, $tipo, ucfirst($nombre)]);
            }
        }
    }
}


    public static function filtrar_solicitud($filtro){
        $conexion = DB::conectar();
        try {
            $baseQuery = "
                SELECT 
                    sa.*, 
                    saf.*,
                    sac.*,
                    sc.*,
                    sd.*,
                    sol.nombre AS nombre,
                    sol.apellido AS apellido
                FROM solicitud_ayuda sa
                LEFT JOIN solicitud_ayuda_fecha saf ON sa.id_doc = saf.id_doc
                LEFT JOIN solicitud_ayuda_correo sac ON sa.id_doc = sac.id_doc
                LEFT JOIN solicitud_categoria sc ON sa.id_doc = sc.id_doc
                LEFT JOIN solicitud_descripcion sd ON sa.id_doc = sd.id_doc
                LEFT JOIN solicitantes sol ON sa.ci = sol.ci
                WHERE sa.invalido = 0
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
                $baseQuery .= " AND sc.categoria = :categoria";
            }

            $baseQuery .= " ORDER BY saf.fecha $order";

            $stmt = $conexion->prepare($baseQuery);

            if ($categoria !== null) {
                $stmt->bindParam(':categoria', $categoria);
            }

            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return ['exito' => true,
                    'datos' => $resultados];

        } catch (PDOException $e) {
            error_log("Error al filtrar solicitud: " . $e->getMessage());
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
                    sa.*, 
                    saf.*,
                    sac.*,
                    sc.*,
                    sd.*
                FROM solicitud_ayuda sa
                LEFT JOIN solicitud_ayuda_fecha saf ON sa.id_doc = saf.id_doc
                LEFT JOIN solicitud_ayuda_correo sac ON sa.id_doc = sac.id_doc
                LEFT JOIN solicitud_categoria sc ON sa.id_doc = sc.id_doc
                LEFT JOIN solicitud_descripcion sd ON sa.id_doc = sd.id_doc
                WHERE DATE(saf.fecha) >= :fecha_inicio 
                AND DATE(saf.fecha) <= :fecha_final 
                AND sa.estado = :estado
                AND sa.invalido = 0
                ORDER BY saf.fecha DESC
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


    //NOTIFICACIONES DE LOS MEDICAMENTOS Y LABORATORIO Y ENVIAR CORREO:

    public static function notificacion_urgencia() {
            $conexion = DB::conectar();
            $rol = $_SESSION['id_rol'];

            try {
                $estadoFiltro = '';
                switch ($rol) {
                    case 1:
                        $estadoFiltro = "sa.estado IN (
                            'En espera del documento físico para ser procesado 0/3',
                            'En Proceso 1/3'
                        )";
                        break;
                    case 2:
                        $estadoFiltro = "sa.estado = 'En Proceso 2/3'";
                        break;
                    case 3:
                        $estadoFiltro = "sa.estado = 'En Proceso 3/3'";
                        break;
                    case 4:
                    default:
                        $estadoFiltro = "sa.estado != 'Solicitud Finalizada (Ayuda Entregada)'";
                        break;
                }

                $stmt = $conexion->prepare("
                    SELECT 
                        sa.*, 
                        saf.*,
                        sac.correo_enviado,
                        sd.*,
                        sc.categoria
                    FROM solicitud_ayuda sa
                    LEFT JOIN solicitud_ayuda_fecha saf ON sa.id_doc = saf.id_doc
                    LEFT JOIN solicitud_ayuda_correo sac ON sa.id_doc = sac.id_doc
                    LEFT JOIN solicitud_descripcion sd ON sa.id_doc = sd.id_doc
                    LEFT JOIN solicitud_categoria sc ON sa.id_doc = sc.id_doc
                    WHERE sc.categoria IN ('Medicamentos', 'Laboratorio')
                    AND $estadoFiltro
                    AND sa.invalido = 0
                    AND saf.fecha_renovacion <= DATE_SUB(NOW(), INTERVAL 5 DAY)
                    ORDER BY
                        CASE sc.categoria
                        WHEN 'Medicamentos' THEN 0
                        WHEN 'Laboratorio' THEN 1
                            ELSE 2
                            END,
                            saf.fecha ASC
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
                                    UPDATE solicitud_ayuda_correo 
                                    SET correo_enviado = 1 
                                    WHERE id_doc = :id_doc
                                ");
                                $stmtUpdate->execute(['id_doc' => $fila['id_doc']]);
                            }
                        }
                    }
                }

                return [
                    'exito' => true,
                    'datos' => $resultados
                ];
            } catch (Exception $e) {
                error_log("Error al filtrar solicitudes por categoría y fecha: " . $e->getMessage());
                return [
                    'exito' => false,
                    'error' => $e->getMessage()
                ];
            }
        }

        public static function verificar_solicitudes($ci){
            try {
                $conexion = DB::conectar();
                $consulta = "
                        SELECT 
                            sa.*,
                            sai.*,
                            sac.correo_enviado,
                            sc.*,
                            sd.*,
                            saf.*,
                            sol.nombre AS nombre,
                            sol.apellido AS apellido
                        FROM solicitud_ayuda sa
                        LEFT JOIN solicitud_ayuda_invalido sai ON sa.id_doc = sai.id_doc
                        LEFT JOIN solicitud_ayuda_correo sac ON sa.id_doc = sac.id_doc
                        LEFT JOIN solicitud_categoria sc ON sa.id_doc = sc.id_doc
                        LEFT JOIN solicitud_descripcion sd ON sa.id_doc = sd.id_doc
                        LEFT JOIN solicitud_ayuda_fecha saf ON sa.id_doc = saf.id_doc
                        LEFT JOIN solicitantes sol ON sa.ci = sol.ci
                        WHERE sa.ci = :ci
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
                    'error' => 'Error al consultar solicitudes: ' . $e->getMessage()
                ];
            }
        }

        public static function traer_comunidades() {
            try {
                $conexion = DB::conectar();
                $consulta = "SELECT comunidad FROM comunidades";
                $stmt = $conexion->prepare($consulta);
                $stmt->execute();
                $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return [
                    'exito' => true,
                    'datos' => $datos
                ];
            } catch (PDOException $e) {
                return [
                    'exito' => false,
                    'error' => $e->getMessage()
                ];
            }
        }

   public static function verificar_solicitante($ci) {
    // Validación: ¿el parámetro está vacío?
    if (empty($ci) || !is_string($ci)) {
        return [
            'exito' => false,
            'error' => 'La cédula proporcionada está vacía o no es válida.'
        ];
    }

    try {
        $conexion = DB::conectar();

        $consulta = "SELECT s.*, sc.*, sco.*, se.*, si.*, sin.*, sp.*, st.*
                    FROM solicitantes s
                    LEFT JOIN solicitantes_comunidad sc ON s.id_solicitante = sc.id_solicitante
                    LEFT JOIN solicitantes_conocimiento sco ON s.id_solicitante = sco.id_solicitante
                    LEFT JOIN solicitantes_extra se ON s.id_solicitante = se.id_solicitante
                    LEFT JOIN solicitantes_info si ON s.id_solicitante = si.id_solicitante
                    LEFT JOIN solicitantes_ingresos sin ON s.id_solicitante = sin.id_solicitante
                    LEFT JOIN solicitantes_patologia sp ON s.id_solicitante = sp.id_solicitante
                    LEFT JOIN solicitantes_trabajo st ON s.id_solicitante = st.id_solicitante
                    WHERE s.ci = :ci";

        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':ci', $ci, PDO::PARAM_STR);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Validación: ¿se encontraron resultados?
        if (!$datos || count($datos) === 0) {
            return [
                'exito' => false,
                'error' => 'No se encontró ningún solicitante con esa cédula.'
            ];
        }

        return [
            'exito' => true,
            'datos' => $datos
        ];
    } catch (PDOException $e) {
        return [
            'exito' => false,
            'error' => 'Error de base de datos: ' . $e->getMessage()
        ];
    }
}

    public static function buscar_filtro($filtro) {
        // Validación básica del término de búsqueda
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
                    sa.*,
                    sai.*,
                    sac.correo_enviado,
                    sc.*,
                    sd.*,
                    saf.*,
                    sol.nombre AS nombre,
                    sol.apellido AS apellido
                FROM solicitud_ayuda sa
                LEFT JOIN solicitud_ayuda_invalido sai ON sa.id_doc = sai.id_doc
                LEFT JOIN solicitud_ayuda_correo sac ON sa.id_doc = sac.id_doc
                LEFT JOIN solicitud_categoria sc ON sa.id_doc = sc.id_doc
                LEFT JOIN solicitud_descripcion sd ON sa.id_doc = sd.id_doc
                LEFT JOIN solicitud_ayuda_fecha saf ON sa.id_doc = saf.id_doc
                LEFT JOIN solicitantes sol ON sa.ci = sol.ci
                WHERE 
                    sa.ci LIKE :filtro OR
                    sa.estado LIKE :filtro OR
                    sc.categoria LIKE :filtro OR
                    sd.descripcion LIKE :filtro OR
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

    public static function solicitud_urgencia($id_doc) {
        try {
            $conexion = DB::conectar();

            $consulta = "SELECT 
                            sa.*,
                            sai.*,
                            sac.correo_enviado,
                            sc.*,
                            sd.*,
                            saf.*,
                            sol.nombre AS nombre,
                            sol.apellido AS apellido
                        FROM solicitud_ayuda sa
                        LEFT JOIN solicitud_ayuda_invalido sai ON sa.id_doc = sai.id_doc
                        LEFT JOIN solicitud_ayuda_correo sac ON sa.id_doc = sac.id_doc
                        LEFT JOIN solicitud_categoria sc ON sa.id_doc = sc.id_doc
                        LEFT JOIN solicitud_descripcion sd ON sa.id_doc = sd.id_doc
                        LEFT JOIN solicitud_ayuda_fecha saf ON sa.id_doc = saf.id_doc
                        LEFT JOIN solicitantes sol ON sa.ci = sol.ci
                        WHERE sa.id_doc = :id_doc";

            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':id_doc', $id_doc, PDO::PARAM_INT);

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
                        'error' => 'No se encontró información para el documento solicitado.'
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
}


