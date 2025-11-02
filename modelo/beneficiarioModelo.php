<?php 
require_once 'conexiondb.php';
class BeneficiarioModelo{

    public static function muestra($ci) {
        $conexion = DB::conectar();

        try {
            // Consulta principal: trae todos los datos relacionados excepto patologías
            $stmt = $conexion->prepare("
                SELECT 
                    s.*, 
                    c.*,
                    co.*,
                    e.*,
                    i.*,
                    ing.*,
                    pr.*,
                    t.*
                FROM solicitantes s
                LEFT JOIN solicitantes_comunidad c ON s.id_solicitante = c.id_solicitante
                LEFT JOIN solicitantes_conocimiento co ON s.id_solicitante = co.id_solicitante
                LEFT JOIN solicitantes_extra e ON s.id_solicitante = e.id_solicitante
                LEFT JOIN solicitantes_info i ON s.id_solicitante = i.id_solicitante
                LEFT JOIN solicitantes_ingresos ing ON s.id_solicitante = ing.id_solicitante
                LEFT JOIN solicitantes_propiedad pr ON s.id_solicitante = pr.id_solicitante
                LEFT JOIN solicitantes_trabajo t ON s.id_solicitante = t.id_solicitante
                WHERE s.ci = :ci
            ");
            $stmt->execute(['ci' => $ci]);
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($datos) {
                // Obtener las patologías relacionadas con el id_solicitante
                $stmt2 = $conexion->prepare("
                    SELECT tip_patologia, nom_patologia
                    FROM solicitantes_patologia
                    WHERE id_solicitante = :id_solicitante
                ");
                $stmt2->execute(['id_solicitante' => $datos['id_solicitante']]);
                $patologias = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                // Añadir las patologías al array principal
                $datos['patologias'] = $patologias;
                $fechaNacimiento = new DateTime($datos['fecha_nacimiento']);
                $hoy = new DateTime();
                $edad = $hoy->diff($fechaNacimiento)->y;
                $datos['edad'] = $edad;
                return [
                    'exito' => true,
                    'datos' => $datos
                ];
            } else {
                return [
                    'exito' => false,
                    'mensaje' => 'No se encontró ningún solicitante con esa CI.'
                ];
            }
        } catch (Exception $e) {
            error_log("Error al buscar solicitante por CI: " . $e->getMessage());
            return [
                'exito' => false,
                'error' => $e->getMessage()
            ];
        }
    }



    public static function lista() {
        try {
            $conexion = DB::conectar();
            $stmt = $conexion->prepare("SELECT * FROM solicitantes");
            $stmt->execute(); 
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        } catch (PDOException $e) {
            error_log("Error al actualizar solicitud: " . $e->getMessage());
            return false;
        }
    }

    public static function registrar_beneficiario($data) {
        $conexion = DB::conectar();
            try {
                self::normalizarCamposTrabajo($data);
                // Validar campos obligatorios
                $camposObligatorios = ['ci','nombre', 'apellido',
                'correo', 'fecha_nacimiento', 'lugar_nacimiento','fecha',
                'edad', 'estado_civil', 'telefono', 'codigo_patria', 'serial_patria',
                'comunidad', 'direc_habita', 'estruc_base', 'profesion', 'nivel_instruc',
                'propiedad', 'propiedad_est',
                'trabajo', 'nombre_insti',
                'nivel_ingreso', 'pension', 'bono'];
                foreach ($camposObligatorios as $campo) {
                    if (!isset($data[$campo]) || $data[$campo] === '') {
                        throw new Exception("Falta el campo obligatorio: $campo");
                    }
                }

                // Verificar si ya existe una constancia con ese id_manual
                $verificar = $conexion->prepare("SELECT COUNT(*) FROM solicitantes WHERE ci = ?");
                $verificar->execute([$data['ci']]);
                $existe = $verificar->fetchColumn();
                if ($existe > 0) {
                    return [
                        'exito' => false,
                        'error' => 'Ya existe una constancia con ese ID.'
                    ];
                }
                $stmt = $conexion->prepare("INSERT INTO solicitantes (nombre, apellido, ci, correo, fecha_creacion) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$data['nombre'], $data['apellido'], $data['ci'], $data['correo'], $data['fecha']]);
                $id_solicitante = $conexion->lastInsertId();
                self::insertarSolicitante($conexion, $id_solicitante, $data);

                return ['exito' => true,
                        'id_solicitante' => $id_solicitante];
            } catch (Exception $e) {
                error_log("Error al insertar el reporte: " . $e->getMessage());
                return ['exito' => false, 'error' => $e->getMessage()];
            }
    }

    private static function insertarSolicitante($conexion, $id, $data) {
        // Insertar comunidad
        $conexion->prepare("
            INSERT INTO solicitantes_comunidad (id_solicitante, comunidad, direc_habita, estruc_base)
            VALUES (?, ?, ?, ?)
        ")->execute([$id, $data['comunidad'], $data['direc_habita'], $data['estruc_base']]);

        // Insertar conocimiento
        $conexion->prepare("
            INSERT INTO solicitantes_conocimiento (id_solicitante, profesion, nivel_instruc)
            VALUES (?, ?, ?)
        ")->execute([$id, $data['profesion'], $data['nivel_instruc']]);

        // Insertar patria
        $conexion->prepare("
            INSERT INTO solicitantes_extra (id_solicitante, codigo_patria, serial_patria)
            VALUES (?, ?, ?)
        ")->execute([$id, $data['codigo_patria'], $data['serial_patria']]);

        // Insertar info personal
        $conexion->prepare("
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
        $conexion->prepare("
            INSERT INTO solicitantes_propiedad (id_solicitante, propiedad, propiedad_est, observaciones_propiedad)
            VALUES (?, ?, ?, ?)
        ")->execute([
            $id,
            $data['propiedad'],
            $data['propiedad_est'],
            $data['observaciones_propiedad']
        ]);

        // Insertar trabajo
        $conexion->prepare("
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
        $conexion->prepare("
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
                        $conexion->prepare("
                            INSERT INTO solicitantes_patologia (id_solicitante, tip_patologia, nom_patologia)
                            VALUES (?, ?, ?)
                        ")->execute([$id, $tipo, $nombre]);
                    }
                }
            }
        }
    }

    private static function normalizarCamposTrabajo(&$data) {
        $data['trabajo'] = isset($data['trabajo']) && trim($data['trabajo']) !== '' ? $data['trabajo'] : 'No tiene';
        $data['direccion_trabajo'] = isset($data['direccion_trabajo']) && trim($data['direccion_trabajo']) !== '' ? $data['direccion_trabajo'] : 'No';
        $data['trabaja_public'] = isset($data['trabaja_public']) && trim($data['trabaja_public']) !== '' ? $data['trabaja_public'] : 'No';
        $data['nombre_insti'] = isset($data['nombre_insti']) && trim($data['nombre_insti']) !== '' ? $data['nombre_insti'] : 'No';
    }

    public static function busqueda_beneficiario($data){
        try {
            $conexion = DB::conectar();

            // Sanitizar y preparar el término de búsqueda
            $filtro = trim($data['filtro_busqueda']);
            $filtro = "%$filtro%"; // Para búsqueda parcial con LIKE

            // Preparar la consulta
            $stmt = $conexion->prepare("
                SELECT * FROM solicitantes 
                WHERE nombre LIKE :filtro 
                OR apellido LIKE :filtro 
                OR ci LIKE :filtro
                ORDER BY nombre ASC
            ");

            // Ejecutar con parámetro seguro
            $stmt->execute([':filtro' => $filtro]);
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return[
                'exito' => true,
                'datos' => $resultado
            ];
        } catch (Exception $e) {
            // Manejo de error: puedes registrar o mostrar un mensaje
            error_log("Error en búsqueda de beneficiario: " . $e->getMessage());
            return [
                'exito' => false,
                'error' => 'Ocurrió un error al realizar la búsqueda. Intente nuevamente más tarde.'
            ];
        }
    }
public static function mostrar_solicitudes($ci){
    try {
        $conexion = DB::conectar();

        $stmt = $conexion->prepare("
            SELECT 
                sa.id_doc AS id,
                sa.id_manual,
                sa.ci,
                CONCAT(sa.estado, '. Solicitud General') AS estado,
                sa.estado AS estado_base,
                sa.invalido,
                COALESCE(saf.fecha, NOW()) AS fecha,
                sad.descripcion,
                sc.categoria,
                sc.tipo_ayuda,
                sol.nombre,
                sol.apellido,
                sad.promotor,
                sad.observaciones
            FROM solicitud_ayuda sa
            LEFT JOIN (
                SELECT id_doc, MAX(fecha) AS fecha
                FROM solicitud_ayuda_fecha
                GROUP BY id_doc
            ) saf ON sa.id_doc = saf.id_doc
            LEFT JOIN solicitud_descripcion sad ON sa.id_doc = sad.id_doc
            LEFT JOIN solicitud_categoria sc ON sa.id_doc = sc.id_doc
            LEFT JOIN solicitantes sol ON sa.ci = sol.ci
            WHERE sa.ci = :ci
            ORDER BY saf.fecha DESC
        ");

        $stmt->execute([':ci' => $ci]);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'exito' => true,
            'datos' => $resultado
        ];
    } catch (Exception $e) {
        error_log("❌ Error en mostrar solicitudes generales: " . $e->getMessage());
        return [
            'exito' => false,
            'error' => 'Ocurrió un error al consultar las solicitudes generales'
        ];
    }
}
    public static function mostrar_solicitudes_despacho($ci){
    try {
        $conexion = DB::conectar();

        $stmt = $conexion->prepare("
            SELECT 
                d.id_despacho AS id,
                d.id_manual,
                d.ci,
                CONCAT(d.estado, '. Despacho') AS estado,
                d.estado AS estado_base,
                d.invalido,
                COALESCE(df.fecha, NOW()) AS fecha,
                di.descripcion,
                dc.categoria,
                dc.tipo_ayuda,
                sol.nombre,
                sol.apellido,
                di.creador AS promotor,
                '' AS observaciones
            FROM despacho d
            LEFT JOIN (
                SELECT id_despacho, MAX(fecha) AS fecha
                FROM despacho_fecha
                GROUP BY id_despacho
            ) df ON d.id_despacho = df.id_despacho
            LEFT JOIN despacho_info di ON d.id_despacho = di.id_despacho
            LEFT JOIN despacho_categoria dc ON d.id_despacho = dc.id_despacho
            LEFT JOIN solicitantes sol ON d.ci = sol.ci
            WHERE d.ci = :ci
            ORDER BY df.fecha DESC
        ");

        $stmt->execute([':ci' => $ci]);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'exito' => true,
            'datos' => $resultado
        ];
    } catch (Exception $e) {
        error_log("❌ Error en mostrar solicitudes de despacho: " . $e->getMessage());
        return [
            'exito' => false,
            'error' => 'Ocurrió un error al consultar las solicitudes de despacho'
        ];
    }
}

public static function mostrar_solicitudes_desarrollo($ci){
    try {
        $conexion = DB::conectar();

        $stmt = $conexion->prepare("
            SELECT 
                sd.id_des AS id,
                sd.id_manual,
                sd.ci,
                CONCAT(sd.estado, '. Solicitud Desarrollo') AS estado,
                sd.estado AS estado_base,
                sd.invalido,
                COALESCE(sdf.fecha, NOW()) AS fecha,
                sdi.descripcion,
                sdt.categoria,
                'Desarrollo Social' AS tipo_ayuda,
                sol.nombre,
                sol.apellido,
                sdi.creador AS promotor,
                '' AS observaciones
            FROM solicitud_desarrollo sd
            LEFT JOIN (
                SELECT id_des, MAX(fecha) AS fecha
                FROM solicitud_desarrollo_fecha
                GROUP BY id_des
            ) sdf ON sd.id_des = sdf.id_des
            LEFT JOIN solicitud_desarrollo_info sdi ON sd.id_des = sdi.id_des
            LEFT JOIN solicitud_desarrollo_tipo sdt ON sd.id_des = sdt.id_des
            LEFT JOIN solicitantes sol ON sd.ci = sol.ci
            WHERE sd.ci = :ci
            ORDER BY sdf.fecha DESC
        ");

        $stmt->execute([':ci' => $ci]);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'exito' => true,
            'datos' => $resultado
        ];
    } catch (Exception $e) {
        error_log("❌ Error en mostrar solicitudes de desarrollo: " . $e->getMessage());
        return [
            'exito' => false,
            'error' => 'Ocurrió un error al consultar las solicitudes de desarrollo'
        ];
    }
}


}



?>