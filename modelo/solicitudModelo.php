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
        $consulta = "SELECT * FROM solicitud_ayuda 
                    WHERE estado IN ($placeholders) 
                    AND invalido != 1 
                    ORDER BY fecha DESC";

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
            'patologia' => $patologias,
            'cantidad' => $cantidadPatologias
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
            $exists = $checkStmt->fetchColumn();
            if ($exists > 0) {
                throw new Exception("❌ El número de documento ya está registrado.");
            }
            self::normalizarCamposTrabajo($data);
            // ✅ 1. Validar campos obligatorios
            $camposObligatorios = [
                'id_manual', 'ci', 'descripcion', 'fecha', 'remitente',
                'categoria', 'tipo_ayuda','ci_user',
                'nombre', 'apellido','correo', 'fecha_nacimiento', 'lugar_nacimiento',
                'edad', 'estado_civil', 'telefono', 'codigo_patria', 'serial_patria',
                'comunidad', 'direc_habita', 'estruc_base', 'profesion', 'nivel_instruc',
                'propiedad', 'propiedad_est',
                'trabajo', 'nombre_insti',
                'nivel_ingreso', 'pension', 'bono'
            ];

            foreach ($camposObligatorios as $campo) {
                if (!isset($data[$campo]) || $data[$campo] === '') {
                    throw new Exception("Falta el campo obligatorio: $campo");
                }
            }

            // ✅ 2. Obtener datos del promotor
            $stmt = $db->prepare("SELECT nombre, apellido FROM usuarios_info WHERE ci = :ci");
            $stmt->execute([':ci' => $data['ci_user']]);
            $promotor = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$promotor) {
                throw new Exception("No se encontró el promotor con CI: " . $data['ci_user']);
            }

            $nombrePromotor = $promotor['nombre'] . ' ' . $promotor['apellido'];

            // ✅ 3. Insertar solicitud de ayuda
            $stmt = $db->prepare("
                INSERT INTO solicitud_ayuda (
                    id_manual, ci, descripcion, estado, fecha, visto,
                    remitente, observaciones, promotor, categoria, tipo_ayuda, fecha_modificacion
                ) VALUES (
                    :id_manual, :ci, :descripcion, :estado, :fecha, :visto,
                    :remitente, :observaciones, :promotor, :categoria, :tipo_ayuda, :fecha_modificacion
                )
            ");
            $stmt->execute([
                ':id_manual' => $data['id_manual'],
                ':ci' => $data['ci'],
                ':descripcion' => $data['descripcion'],
                ':estado' => 'En espera del documento físico para ser procesado 0/3',
                ':fecha' => $data['fecha'],
                ':visto' => 0,
                ':remitente' => $data['remitente'],
                ':observaciones' => $data['observaciones'],
                ':promotor' => $nombrePromotor,
                ':categoria' => $data['categoria'],
                ':tipo_ayuda' => $data['tipo_ayuda'],
                ':fecha_modificacion' => $data['fecha']
            ]);

            // ✅ 4. Verificar si el solicitante ya existe
            $stmt = $db->prepare("SELECT id_solicitante FROM solicitantes WHERE ci = :ci");
            $stmt->execute([':ci' => $data['ci']]);
            $solicitante = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($solicitante) {
                $id_solicitante = $solicitante['id_solicitante'];

                // 🔄 Actualizar datos
                self::actualizarSolicitante($db, $id_solicitante, $data);
            } else {
                // 🆕 Insertar nuevo solicitante
                $stmt = $db->prepare("INSERT INTO solicitantes (nombre, apellido, ci, correo, fecha_creacion) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$data['nombre'], $data['apellido'], $data['ci'], $data['correo'], $data['fecha']]);
                $id_solicitante = $db->lastInsertId();

                self::insertarSolicitante($db, $id_solicitante, $data);
            }
            $idInsertado = $conexion->lastInsertId();
            $db->commit();
            return ['exito' => true,
                    'id_doc' => $idInsertado
            ];

        } catch (Exception $e) {
            $db->rollBack();
            error_log("Error al registrar solicitud: " . $e->getMessage());
            return ['exito' => false, 'error' => $e->getMessage()];
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
            SET fecha_nacimiento = ?, lugar_nacimiento = ?, edad = ?, estado_civil = ?, telefono = ?
            WHERE id_solicitante = ?
        ")->execute([
            $data['fecha_nacimiento'],
            $data['lugar_nacimiento'],
            $data['edad'],
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

        if (!empty($data['tip_patologia']) && is_array($data['tip_patologia'])) {
            $esSinPatologia = count($data['tip_patologia']) === 1 && strtolower($data['tip_patologia'][0]) === 'no';
            if (!$esSinPatologia) {
                foreach ($data['tip_patologia'] as $i => $tipo) {
                    $nombre = $data['nom_patologia'][$i] ?? '';
                    if (!empty($tipo) && !empty($nombre)) {
                        $db->prepare("
                            INSERT INTO solicitantes_patologia (id_solicitante, tip_patologia, nom_patologia)
                            VALUES (?, ?, ?)
                        ")->execute([$id, $tipo, $nombre]);
                    }
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
            INSERT INTO solicitantes_info (id_solicitante, fecha_nacimiento, lugar_nacimiento, edad, estado_civil, telefono)
            VALUES (?, ?, ?, ?, ?, ?)
        ")->execute([
            $id,
            $data['fecha_nacimiento'],
            $data['lugar_nacimiento'],
            $data['edad'],
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
        if (!empty($data['tip_patologia']) && is_array($data['tip_patologia'])) {
            $esSinPatologia = count($data['tip_patologia']) === 1 && strtolower($data['tip_patologia'][0]) === 'no';
            if (!$esSinPatologia) {
                foreach ($data['tip_patologia'] as $i => $tipo) {
                    $nombre = $data['nom_patologia'][$i] ?? '';
                    if (!empty($tipo) && !empty($nombre)) {
                        $db->prepare("
                            INSERT INTO solicitantes_patologia (id_solicitante, tip_patologia, nom_patologia)
                            VALUES (?, ?, ?)
                        ")->execute([$id, $tipo, $nombre]);
                    }
                }
            }
        }
    }

    public static function filtrar_solicitud($filtro){
    $conexion = DB::conectar();

    try {
        switch($filtro){
            case "recientes":
                $stmt = $conexion->prepare("SELECT * FROM solicitud_ayuda ORDER BY fecha DESC");
                break;

            case "antiguos":
                $stmt = $conexion->prepare("SELECT * FROM solicitud_ayuda ORDER BY fecha ASC");
                break;

            case "medicinas":
                $stmt = $conexion->prepare("SELECT * FROM solicitud_ayuda WHERE categoria = 'Medicamentos'");
                break;

            case "laboratorio":
                $stmt = $conexion->prepare("SELECT * FROM solicitud_ayuda WHERE categoria = 'Laboratorio'");
                break;

            case "ayuda_tecnica":
                $stmt = $conexion->prepare("SELECT * FROM solicitud_ayuda WHERE categoria = 'Ayudas Técnicas'");
                break;

            case "enseres":
                $stmt = $conexion->prepare("SELECT * FROM solicitud_ayuda WHERE categoria = 'Enseres'");
                break;

            case "urgentes":
                $stmt = $conexion->prepare("SELECT * FROM solicitud_ayuda WHERE categoria = 'urgentes'");
                break;

            default:
                $stmt = $conexion->prepare("SELECT * FROM solicitud_ayuda ");
                break;
        }

        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'exito' => true,
            'datos' => $resultados
        ];

    } catch (Exception $e) {
        error_log("Error al filtrar solicitudes: " . $e->getMessage());
        return [
            'exito' => false,
            'error' => $e->getMessage()
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
                SELECT * FROM solicitud_ayuda 
                WHERE fecha >= :fecha_inicio 
                AND fecha <= :fecha_final 
                AND estado = :estado
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

    //NOTIFICACIONES DE LOS MEDICAMENTOS Y ENVIAR CORREO:

    public static function notiMedicamentos() {
    $conexion = DB::conectar();
    $rol = $_SESSION['id_rol'];
    try {
        // Consulta general (sin filtrar por correo_enviado)
        switch ($rol) {
        case 1:
            $stmt = $conexion->prepare("
                SELECT * FROM solicitud_ayuda 
                WHERE categoria = :categoria 
                AND estado IN (
                    'En espera del documento físico para ser procesado 0/3',
                    'En Proceso 1/3'
                )
                AND estado != 'Solicitud Finalizada (Ayuda Entregada)'
                AND fecha_modificacion <= DATE_SUB(NOW(), INTERVAL 5 DAY)
                AND invalido = 0
            ");
            break;

        case 2:
            $stmt = $conexion->prepare("
                SELECT * FROM solicitud_ayuda 
                WHERE categoria = :categoria 
                AND estado = 'En Proceso 2/3'
                AND estado != 'Solicitud Finalizada (Ayuda Entregada)'
                AND fecha_modificacion <= DATE_SUB(NOW(), INTERVAL 5 DAY)
                AND invalido = 0
            ");
            break;

        case 3:
            $stmt = $conexion->prepare("
                SELECT * FROM solicitud_ayuda 
                WHERE categoria = :categoria 
                AND estado = 'En Proceso 3/3'
                AND estado != 'Solicitud Finalizada (Ayuda Entregada)'
                AND fecha_modificacion <= DATE_SUB(NOW(), INTERVAL 5 DAY)
                AND invalido = 0
            ");
            break;

        case 4:
        default:
            $stmt = $conexion->prepare("
                SELECT * FROM solicitud_ayuda 
                WHERE categoria = :categoria 
                AND estado != 'Solicitud Finalizada (Ayuda Entregada)'
                AND fecha_modificacion <= DATE_SUB(NOW(), INTERVAL 5 DAY)
                AND invalido = 0
            ");
            break;
    }


        $stmt->execute(['categoria' => 'Medicamentos']);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Enviar correos solo si correo_enviado = 0
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
                            UPDATE solicitud_ayuda 
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








}

?>