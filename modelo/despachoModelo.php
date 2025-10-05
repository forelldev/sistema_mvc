<?php 
require_once 'conexiondb.php';
class Despacho{
       // MOSTRAR LISTA DE SOLICITUDES DE DESPACHO:
    public static function buscarLista (){
        $conexion = DB::conectar();
        $consulta = "
                SELECT 
                    d.*, 
                    dd.asunto, dd.creador,
                    df.fecha, df.fecha_modificacion, df.visto
                FROM despacho d
                LEFT JOIN despacho_descripcion dd ON d.id_despacho = dd.id_despacho
                LEFT JOIN despacho_fecha df ON d.id_despacho = df.id_despacho
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
            // Verificar si el id_manual ya existe
            $checkStmt = $db->prepare("SELECT COUNT(*) FROM despacho WHERE id_manual = :id_manual");
            $checkStmt->execute([':id_manual' => $data['id_manual']]);
            $exists = $checkStmt->fetchColumn();
            if ($exists > 0) {
                throw new Exception("❌ El número de documento ya está registrado.");
            }
            // ✅ 1. Validar campos obligatorios
            $camposObligatorios = [
                'id_manual', 'ci', 'asunto', 'fecha','nombre','apellido','telefono','direc_habita'
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
            
            // Asunto y creador

            $stmt = $db->prepare("
                INSERT INTO despacho_descripcion (
                    id_despacho, asunto, creador
                ) VALUES (
                    :id_despacho, :asunto, :creador
                )
            ");
            $stmt->execute([
                ':id_despacho' => $id_despacho,
                ':asunto' => $data['asunto'],
                ':creador' => $nombrePromotor
            ]);

            // Fechas, y visto

            $stmt = $db->prepare("
                INSERT INTO despacho_fecha (
                    id_despacho, fecha, fecha_modificacion, visto
                ) VALUES (
                    :id_despacho, :fecha, :fecha_modificacion, :visto
                )
            ");
            $stmt->execute([
                ':id_despacho' => $id_despacho,
                ':fecha' => $data['fecha'],
                ':fecha_modificacion' => $data['fecha'],
                ':visto' => 0
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
}
?>