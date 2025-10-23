<?php 
require_once 'conexiondb.php';
require_once 'correoModelo.php';
class Despacho{
       // MOSTRAR LISTA DE SOLICITUDES DE DESPACHO:
    public static function buscarLista (){
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
                WHERE d.invalido = 0
                ORDER BY df.fecha DESC
            ";
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
            if (empty($data['prioridad'])) {
                $data['prioridad'] = 'Baja';
            }
            // Verificar si el id_manual ya existe
            $checkStmt = $db->prepare("SELECT COUNT(*) FROM despacho WHERE id_manual = :id_manual");
            $checkStmt->execute([':id_manual' => $data['id_manual']]);
            $exists = $checkStmt->fetchColumn();
            if ($exists > 0) {
                throw new Exception("❌ El número de documento ya está registrado.");
            }
            // ✅ 1. Validar campos obligatorios
            $camposObligatorios = [
                'id_manual', 'ci', 'descripcion', 'fecha','nombre','apellido','telefono','direc_habita','tipo_ayuda','categoria','prioridad'
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

            $id_despacho = $db->lastInsertId(); // Obtener el ID generado
            
            // Descripcion y creador

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

            // Fechas, y visto

            $stmt = $db->prepare("
                INSERT INTO despacho_fecha (
                    id_despacho, fecha, fecha_modificacion, fecha_renovacion, visto
                ) VALUES (
                    :id_despacho, :fecha, :fecha_modificacion,:fecha_renovacion, :visto
                )
            ");
            $stmt->execute([
                ':id_despacho' => $id_despacho,
                ':fecha' => $data['fecha'],
                ':fecha_modificacion' => $data['fecha'],
                ':fecha_renovacion' => $data['fecha'],
                ':visto' => 0
            ]);

            $stmt = $db->prepare("
                INSERT INTO despacho_categoria (
                    id_despacho, categoria, tipo_ayuda, prioridad
                ) VALUES (
                    :id_despacho, :categoria, :tipo_ayuda, :prioridad
                )
            ");
            $stmt->execute([
                ':id_despacho' => $id_despacho,
                ':categoria' => $data['categoria'],
                ':tipo_ayuda' => $data['tipo_ayuda'],
                ':prioridad' => $data['prioridad']
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
                $stmt = $db->prepare("INSERT INTO solicitantes (nombre, apellido, ci) VALUES (?, ?, ?)");
                $stmt->execute([$data['nombre'], $data['apellido'], $data['ci']]);
                $id_solicitante = $db->lastInsertId();

                self::insertarSolicitante($db, $id_solicitante, $data);
            }

            $db->commit();
            return ['exito' => true];

        } catch (Exception $e) {
            $db->rollBack();
            error_log("Error al registrar solicitud: " . $e->getMessage());
            return ['exito' => false, 'error' => $e->getMessage()];
        }
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
            SET  direc_habita = ?
            WHERE id_solicitante = ?
        ")->execute([$data['direc_habita'], $id]);

        // Actualizar info personal
        $db->prepare("
            UPDATE solicitantes_info 
            SET telefono = ?
            WHERE id_solicitante = ?
        ")->execute([
            $data['telefono'],
            $id
        ]);

    }

    private static function insertarSolicitante($db, $id, $data) {
        // Insertar comunidad
        $db->prepare("
            INSERT INTO solicitantes_comunidad (id_solicitante, direc_habita)
            VALUES (?, ?)
        ")->execute([$id, $data['direc_habita']]);

        // Insertar info personal
        $db->prepare("
            INSERT INTO solicitantes_info (id_solicitante, telefono)
            VALUES (?, ?)
        ")->execute([
            $id,
            $data['telefono']
        ]);
    }

    public static function notificacion_urgencia() {
        $conexion = DB::conectar();

        try {
            $stmt = $conexion->prepare("
                SELECT 
                    d.*, 
                    di.*,
                    df.*,
                    dc.correo_enviado,
                    dc.categoria,
                    sol.nombre,
                    sol.correo,
                    sol.ci
                FROM despacho d
                LEFT JOIN despacho_info di ON d.id_despacho = di.id_despacho
                LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
                LEFT JOIN despacho_categoria dc ON d.id_despacho = dc.id_despacho
                LEFT JOIN solicitantes sol ON d.ci = sol.ci
                WHERE d.invalido = 0
                AND dc.categoria IN ('Medicamentos', 'Laboratorio')
                AND df.fecha <= DATE_SUB(NOW(), INTERVAL 5 DAY)
                ORDER BY 
                    CASE dc.categoria
                        WHEN 'Medicamentos' THEN 0
                        WHEN 'Laboratorio' THEN 1
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
                            UPDATE despacho_categoria 
                            SET correo_enviado = 1 
                            WHERE id_despacho = :id_despacho
                        ");
                        $stmtUpdate->execute(['id_despacho' => $fila['id_despacho']]);
                    }
                }
            }

            return [
                'exito' => true,
                'datos' => $resultados
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
                $datos = $stmt->fetch(PDO::FETCH_ASSOC);

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
                    sol.*
                FROM despacho d
                LEFT JOIN despacho_info di ON d.id_despacho = di.id_despacho
                LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
                LEFT JOIN despacho_categoria dc ON d.id_despacho = dc.id_despacho
                LEFT JOIN solicitantes sol ON d.ci = sol.ci
                WHERE 
                    d.ci LIKE :filtro OR
                    d.estado LIKE :filtro OR
                    dc.categoria LIKE :filtro OR
                    di.descripcion LIKE :filtro OR
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
}

?>