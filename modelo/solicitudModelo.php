<?php 
require_once 'conexiondb.php';
class Solicitud{
    public static function buscarLista (){
        $conexion = DB::conectar();
        $consulta = "SELECT * FROM solicitud_ayuda ORDER BY fecha DESC";
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
    public static function buscarCi($ci){
                $conexion = DB::conectar();
            // Consulta para buscar en todas las tablas de solicitantes
            $consulta = "SELECT 
                            s.id_solicitante, s.nombre, s.apellido, 
                            si.fecha_nacimiento, si.lugar_nacimiento, si.estado_civil, si.telefono,
                            sc.comunidad, sc.direc_habita, sc.estruc_base,
                            sc.profesion, sc.nivel_instruc,
                            se.codigo_patria, se.serial_patria,
                            st.trabajo, st.direccion_trabajo, st.trabaja_public, st.nombre_insti,
                            sp.propiedad, sp.propiedad_est, sp.observaciones_propiedad
                        FROM solicitantes s
                        LEFT JOIN solicitantes_info si ON s.id_solicitante = si.id_solicitante
                        LEFT JOIN solicitantes_comunidad sc ON s.id_solicitante = sc.id_solicitante
                        LEFT JOIN solicitantes_conocimiento sk ON s.id_solicitante = sk.id_solicitante
                        LEFT JOIN solicitantes_extra se ON s.id_solicitante = se.id_solicitante
                        LEFT JOIN solicitantes_trabajo st ON s.id_solicitante = st.id_solicitante
                        LEFT JOIN solicitantes_propiedad sp ON s.id_solicitante = sp.id_solicitante
                        WHERE s.ci = :ci";
                        
            try {
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam(':ci', $ci, PDO::PARAM_STR); 
                $stmt->execute();
                $mostrar = $stmt->fetch(PDO::FETCH_ASSOC);
                // Cierra el cursor para liberar recursos
                $stmt->closeCursor();
                if ($mostrar) {
                    return [
                        'exito' => true,
                        'datos' => $mostrar
                    ];
                } else {
                    return [
                        'exito' => false
                    ];
                }

            } catch (PDOException $e) {
                error_log("Error al buscar solicitante por CI: " . $e->getMessage());
                return [
                    'exito' => false,
                    'error' => $e->getMessage()
                ];
            } finally {
                $conexion = null;
            }
    }

public static function enviarForm($data) {
    $db = DB::conectar();
    $db->beginTransaction();

    try {
        // 1. Obtener datos del promotor
        $ci_user = $data['ci_user'];
        $consulta = "
            SELECT ui.* 
            FROM usuarios_info ui
            INNER JOIN usuarios u ON ui.id_usuario = u.id_usuario
            WHERE u.ci = :ci
        ";
        $busqueda = $db->prepare($consulta);
        $busqueda->bindParam(':ci', $ci_user, PDO::PARAM_STR);
        $busqueda->execute();
        $resultado = $busqueda->fetch(PDO::FETCH_ASSOC);

        // 2. Insertar solicitud de ayuda
        $stmt = $db->prepare("
            INSERT INTO solicitud_ayuda (
                id_manual, ci, descripcion, estado, fecha, visto, 
                remitente, observaciones, promotor, categoria, tipo_ayuda
            ) VALUES (
                :id_manual, :ci, :descripcion, :estado, :fecha, :visto, 
                :remitente, :observaciones, :promotor, :categoria, :tipo_ayuda
            )
        ");
        $stmt->execute([
            ':id_manual' => $data['id_manual'],
            ':ci' => $data['ci'],
            ':descripcion' => $data['descripcion'],
            ':estado' => 'En Espera Del Documento Físico Para Ser Procesado 0/3',
            ':fecha' => $data['fecha'],
            ':visto' => 0,
            ':remitente' => $data['remitente'],
            ':observaciones' => $data['observaciones'],
            ':promotor' => $resultado['nombre'] . ' ' . $resultado['apellido'],
            ':categoria' => $data['categoria'],
            ':tipo_ayuda' => $data['tipo_ayuda']
        ]);

        // 3. Insertar solicitante
        $db->prepare("INSERT INTO solicitantes (nombre, apellido, ci) VALUES (?, ?, ?)")
           ->execute([$data['nombre'], $data['apellido'], $data['ci']]);
        $id_solicitante = $db->lastInsertId();

        // 4. Insertar datos de comunidad
        $db->prepare("
            INSERT INTO solicitantes_comunidad (id_solicitante, comunidad, direc_habita, estruc_base)
            VALUES (?, ?, ?, ?)
        ")->execute([$id_solicitante, $data['comunidad'], $data['direc_habita'], $data['estruc_base']]);

        // 5. Insertar datos educativos
        $db->prepare("
            INSERT INTO solicitantes_conocimiento (id_solicitante, profesion, nivel_instruc)
            VALUES (?, ?, ?)
        ")->execute([$id_solicitante, $data['profesion'], $data['nivel_instruc']]);

        // 6. Insertar datos patria
        $db->prepare("
            INSERT INTO solicitantes_extra (id_solicitante, codigo_patria, serial_patria)
            VALUES (?, ?, ?)
        ")->execute([$id_solicitante, $data['codigo_patria'], $data['serial_patria']]);

        // 7. Insertar información personal
        $db->prepare("
            INSERT INTO solicitantes_info (
                id_solicitante, fecha_nacimiento, lugar_nacimiento, edad, estado_civil, telefono
            ) VALUES (?, ?, ?, ?, ?, ?)
        ")->execute([
            $id_solicitante,
            $data['fecha_nacimiento'],
            $data['lugar_nacimiento'],
            $data['edad'],
            $data['estado_civil'],
            $data['telefono']
        ]);

        // 8. Insertar patologías (si existen)
        if (!empty($data['tip_patologia']) && is_array($data['tip_patologia'])) {
            $esSinPatologia = count($data['tip_patologia']) === 1 && strtolower($data['tip_patologia'][0]) === 'no';
            if (!$esSinPatologia) {
                foreach ($data['tip_patologia'] as $i => $tipo) {
                    $nombre = $data['nom_patologia'][$i] ?? '';
                    if (!empty($tipo) && !empty($nombre)) {
                        $db->prepare("
                            INSERT INTO solicitantes_patologia (id_solicitante, tip_patologia, nom_patologia)
                            VALUES (?, ?, ?)
                        ")->execute([$id_solicitante, $tipo, $nombre]);
                    }
                }
            }
        }

        // 9. Insertar propiedad
        $db->prepare("
            INSERT INTO solicitantes_propiedad (
                id_solicitante, propiedad, propiedad_est, observaciones_propiedad
            ) VALUES (?, ?, ?, ?)
        ")->execute([
            $id_solicitante,
            $data['propiedad'],
            $data['propiedad_est'],
            $data['observaciones_propiedad']
        ]);

        // 10. Insertar datos laborales
        $db->prepare("
            INSERT INTO solicitantes_trabajo (
                id_solicitante, trabajo, direccion_trabajo, trabaja_public, nombre_insti
            ) VALUES (?, ?, ?, ?, ?)
        ")->execute([
            $id_solicitante,
            $data['trabajo'],
            $data['direccion_trabajo'],
            $data['trabaja_public'],
            $data['nombre_insti']
        ]);

        $db->prepare("
            INSERT INTO solicitantes_ingresos (
                id_solicitante, nivel_ingreso, pensionado, bono
            ) VALUES (?, ?, ?, ?)
        ")->execute([
            $id_solicitante,
            $data['nivel_ingreso'],
            $data['pensionado'],
            $data['bono'],
        ]);

        $db->commit();
        return true;

    } catch (Exception $e) {
    $db->rollBack();
    echo "Error: " . $e->getMessage(); // 👈 Esto mostrará el error exacto
    return false;
    }
}
}

?>