<?php 
require_once 'conexiondb.php';
class BeneficiarioModelo{
    public static function muestra($ci) {
    $conexion = DB::conectar();

    try {
        $stmt = $conexion->prepare("
            SELECT * FROM solicitantes 
            WHERE ci = :ci
        ");
        $stmt->execute(['ci' => $ci]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return [
                'exito' => true,
                'datos' => $resultado
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
                // Validar campos obligatorios
                $camposObligatorios = ['id_manual', 'ci','categoria','nombre', 'apellido',
                'correo', 'fecha_nacimiento', 'lugar_nacimiento','fecha',
                'edad', 'estado_civil', 'telefono', 'codigo_patria', 'serial_patria',
                'comunidad', 'direc_habita', 'estruc_base', 'profesion', 'nivel_instruc',
                'propiedad', 'propiedad_est', 'observaciones_propiedad',
                'trabajo', 'direccion_trabajo', 'trabaja_public', 'nombre_insti',
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
                $stmt = $db->prepare("INSERT INTO solicitantes (nombre, apellido, ci, correo, fecha_creacion) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$data['nombre'], $data['apellido'], $data['ci'], $data['correo'], $data['fecha']]);
                $id_solicitante = $db->lastInsertId();
                self::insertarSolicitante($db, $id_solicitante, $data);

                return ['exito' => true,
                        'id_solicitante' => $id_solicitante];
            } catch (Exception $e) {
                error_log("Error al insertar el reporte: " . $e->getMessage());
                return ['exito' => false, 'error' => $e->getMessage()];
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


}
?>