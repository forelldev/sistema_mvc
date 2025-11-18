<?php 
require_once 'conexiondb.php';
class reportesModelo{

    public static function mostrarReportes($pagina = 1, $porPagina = 10) {
        try {
            $conexion = DB::conectar();
            $offset = ($pagina - 1) * $porPagina;

            // Obtener total de registros
            $totalConsulta = $conexion->query("SELECT COUNT(*) FROM reportes_acciones");
            $totalRegistros = $totalConsulta->fetchColumn();
            $consulta = "
                SELECT r.*, ui.nombre
                FROM reportes_entradas r
                INNER JOIN usuarios_info ui ON r.ci = ui.ci
                ORDER BY r.fecha_entrada DESC
                LIMIT :limite OFFSET :offset
            ";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindValue(':limite', $porPagina, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                'exito' => true,
                'datos' => $datos,
                'total' => $totalRegistros,
                'pagina' => $pagina,
                'porPagina' => $porPagina
            ];
        } catch (PDOException $e) {
            return ['exito' => false, 'mensaje' => $e->getMessage()];
        }
    }

   public static function mostrarReportesAcciones($pagina = 1, $porPagina = 10) {
        try {
            $conexion = DB::conectar();
            $offset = ($pagina - 1) * $porPagina;

            // Total real de registros (sin filtrar)
            $totalConsulta = $conexion->query("SELECT COUNT(*) FROM reportes_acciones");
            $totalRegistros = $totalConsulta->fetchColumn();

            // Registros paginados
            $consulta = "
                SELECT ra.*, ui.nombre
                FROM reportes_acciones ra
                INNER JOIN usuarios_info ui ON ra.ci = ui.ci
                ORDER BY ra.fecha DESC
                LIMIT :limite OFFSET :offset
            ";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindValue(':limite', $porPagina, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $datosFiltrados = [];

            foreach ($datos as $fila) {
                $id_doc = $fila['id_doc'];
                $accion = strtolower($fila['accion']);

                preg_match('/\((.*?)\)/', $accion, $match);
                $tipo = strtolower(trim($match[1] ?? 'general'));

                switch ($tipo) {
                    case 'despacho':
                        $query = "SELECT id_manual FROM despacho WHERE id_despacho = :id";
                        $fila['origen'] = 'despacho';
                        $fila['id_despacho'] = $id_doc; // ✅ agregar esto
                        break;
                    case 'desarrollo':
                        $query = "SELECT id_manual FROM solicitud_desarrollo WHERE id_des = :id";
                        $fila['origen'] = 'desarrollo';
                        $fila['id_des'] = $id_doc; // ✅ agregar esto
                        break;
                    default:
                        $query = "SELECT id_manual FROM solicitud_ayuda WHERE id_doc = :id";
                        $fila['origen'] = 'general';
                        $fila['id_doc'] = $id_doc; // ✅ asegurar que esté presente
                        break;
                }


            

                $stmtManual = $conexion->prepare($query);
                $stmtManual->bindValue(':id', $id_doc, PDO::PARAM_INT);
                $stmtManual->execute();
                $id_manual = $stmtManual->fetchColumn();

                if ($id_manual) {
                    $fila['id_manual'] = $id_manual;
                    $datosFiltrados[] = $fila;
                } else {
                    // No elimines el registro aquí, solo ignóralo
                    continue;
                }
            }

            return [
                'exito' => true,
                'datos' => $datosFiltrados,
                'total' => $totalRegistros, // ← usar total real para paginación
                'pagina' => $pagina,
                'porPagina' => $porPagina
            ];
        } catch (PDOException $e) {
            return ['exito' => false, 'mensaje' => $e->getMessage()];
        }
    }




    public static function mostrarLimites() {
        try {
        $conexion = DB::conectar();
        $consulta = "SELECT * FROM roles";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Agregar número de cuentas por cada rol
        foreach ($roles as &$rol) {
            $id_rol = $rol['id_rol'];
            $consultaUsuarios = "SELECT COUNT(*) AS num_cuentas FROM usuarios WHERE id_rol = :id_rol";
            $stmtUsuarios = $conexion->prepare($consultaUsuarios);
            $stmtUsuarios->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmtUsuarios->execute();
            $resultadoUsuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC);
            $rol['num_cuentas'] = $resultadoUsuarios['num_cuentas'] ?? 0;
        }

        return [
            'exito' => !empty($roles),
            'datos' => $roles,
            'mensaje' => empty($roles) ? 'No se encontraron roles' : null
        ];
    } catch (PDOException $e) {
        return [
            'exito' => false,
            'mensaje' => 'Error en la consulta: ' . $e->getMessage()
        ];
    }
    }

    public static function cargarDatos($id_rol){
        $conexion = DB::conectar();
            $stmt =$conexion->prepare("SELECT * FROM roles WHERE id_rol = ?");
            $stmt->execute([$id_rol]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
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

        public static function actualizarLimite($id_rol, $nuevo_limite) {
            try {
                $conexion = DB::conectar();
                $consulta = "UPDATE roles SET limite = :limite WHERE id_rol = :id_rol";
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam(':limite', $nuevo_limite, PDO::PARAM_INT);
                $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
                $stmt->execute();

                return ['exito' => true];
            } catch (PDOException $e) {
                return ['exito' => false, 'mensaje' => $e->getMessage()];
            }
        }

        public static function contarUsuariosPorRol($id_rol) {
            try {
                $conexion = DB::conectar();
                $consulta = "SELECT COUNT(*) AS total FROM usuarios WHERE id_rol = :id_rol";
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
                $stmt->execute();
                $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return ['exito' => true, 'datos' => $datos];
            } catch (PDOException $e) {
                return ['exito' => false, 'mensaje' => $e->getMessage()];
            }
    }

        public static function obtenerUsuariosPorRol($id_rol) {
            try {
                $conexion = DB::conectar();
                $consulta = "
                    SELECT u.*, ui.nombre 
                    FROM usuarios u
                    INNER JOIN usuarios_info ui ON u.ci = ui.ci
                    WHERE u.id_rol = :id_rol
                    ORDER BY u.ci DESC
                ";
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
                $stmt->execute();
                $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return ['exito' => true, 'datos' => $datos];
            } catch (PDOException $e) {
                return ['exito' => false, 'mensaje' => $e->getMessage()];
            }
        }


       public static function eliminarUsuario($ci) {
        try {
            $conexion = DB::conectar();
            $consulta = "DELETE FROM usuarios WHERE ci = :ci AND especial = 0";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':ci', $ci, PDO::PARAM_INT); // Usa PARAM_STR si ci no es numérico
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return ['exito' => true];
            } else {
                return ['exito' => false, 'mensaje' => 'No se puede eliminar este usuario!'];
            }
        } catch (PDOException $e) {
            return ['exito' => false, 'mensaje' => $e->getMessage()];
        }
    }


        public static function fecha_filtro($datos) {
            $conexion = DB::conectar();
            $fecha_inicio = $datos['fecha_inicio'];
            $fecha_final = $datos['fecha_final'];
            $pagina = isset($datos['pagina']) ? (int)$datos['pagina'] : 1;
            $porPagina = isset($datos['porPagina']) ? (int)$datos['porPagina'] : 10;
            $offset = ($pagina - 1) * $porPagina;

            try {
                // Obtener el total de registros filtrados
                $totalStmt = $conexion->prepare("
                    SELECT COUNT(*) 
                    FROM reportes_entradas re
                    WHERE re.fecha_entrada >= :fecha_inicio 
                    AND re.fecha_salida <= :fecha_final
                ");
                $totalStmt->bindParam(':fecha_inicio', $fecha_inicio);
                $totalStmt->bindParam(':fecha_final', $fecha_final);
                $totalStmt->execute();
                $totalRegistros = $totalStmt->fetchColumn();

                // Obtener los datos paginados
                $stmt = $conexion->prepare("
                    SELECT re.*, ui.nombre 
                    FROM reportes_entradas re
                    INNER JOIN usuarios_info ui ON re.ci = ui.ci
                    WHERE re.fecha_entrada >= :fecha_inicio 
                    AND re.fecha_salida <= :fecha_final
                    ORDER BY re.fecha_entrada DESC, re.fecha_salida DESC
                    LIMIT :limite OFFSET :offset
                ");
                $stmt->bindParam(':fecha_inicio', $fecha_inicio);
                $stmt->bindParam(':fecha_final', $fecha_final);
                $stmt->bindValue(':limite', $porPagina, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return [
                    'exito' => true,
                    'datos' => $resultados,
                    'total' => $totalRegistros,
                    'pagina' => $pagina,
                    'porPagina' => $porPagina
                ];
            } catch (Exception $e) {
                error_log("Error al filtrar reportes por fecha: " . $e->getMessage());
                return [
                    'exito' => false,
                    'error' => $e->getMessage()
                ];
            }
        }


 public static function filtro_acciones($fecha, $oficina, $pagina = 1, $porPagina = 10) {
    $conexion = DB::conectar();
    $fecha_inicio = $fecha . ' 00:00:00';
    $fecha_fin = $fecha . ' 23:59:59';
    $offset = ($pagina - 1) * $porPagina;

    // Tipos de origen y sus tablas
    $tipos = [
        'General' => ['tipo' => 'general', 'tabla' => 'solicitud_ayuda', 'campo' => 'id_doc'],
        'Desarrollo Social' => ['tipo' => 'desarrollo', 'tabla' => 'solicitud_desarrollo', 'campo' => 'id_des'],
        'Despacho' => ['tipo' => 'despacho', 'tabla' => 'despacho', 'campo' => 'id_despacho']
    ];

    // Condición SQL según oficina
    $condicionOficina = '';
    $parametrosOficina = [];

    if ($oficina === 'todas') {
        $condicionOficina = "AND (" . implode(" OR ", array_map(fn($k) => "ra.accion LIKE '%($k)%'", array_keys($tipos))) . ")";
    } elseif (!empty($oficina) && isset($tipos[$oficina])) {
        $condicionOficina = "AND ra.accion LIKE :oficina";
        $parametrosOficina[':oficina'] = "%(" . $oficina . ")%";
    }

    try {
        // Total de registros
        $sqlTotal = "
            SELECT COUNT(*) 
            FROM reportes_acciones ra
            INNER JOIN usuarios u ON ra.ci = u.ci
            INNER JOIN usuarios_info ui ON ra.ci = ui.ci
            WHERE ra.fecha BETWEEN :fecha_inicio AND :fecha_fin
            $condicionOficina
        ";
        $totalStmt = $conexion->prepare($sqlTotal);
        $totalStmt->bindParam(':fecha_inicio', $fecha_inicio);
        $totalStmt->bindParam(':fecha_fin', $fecha_fin);
        foreach ($parametrosOficina as $key => $val) {
            $totalStmt->bindValue($key, $val);
        }
        $totalStmt->execute();
        $totalRegistros = $totalStmt->fetchColumn();

        // Datos paginados
        $sqlDatos = "
            SELECT ra.*, u.id_rol, ui.nombre
            FROM reportes_acciones ra
            INNER JOIN usuarios u ON ra.ci = u.ci
            INNER JOIN usuarios_info ui ON ra.ci = ui.ci
            WHERE ra.fecha BETWEEN :fecha_inicio AND :fecha_fin
            $condicionOficina
            ORDER BY ra.fecha DESC
            LIMIT :limite OFFSET :offset
        ";
        $stmt = $conexion->prepare($sqlDatos);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        foreach ($parametrosOficina as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->bindValue(':limite', $porPagina, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Enriquecer cada fila con id_manual y origen
        foreach ($resultados as &$fila) {
            $fila['id_manual'] = 'N/A';
            $fila['origen'] = 'general';

            foreach ($tipos as $clave => $info) {
                if (str_contains($fila['accion'], "($clave)")) {
                    $fila['origen'] = $info['tipo'];

                    // Acceder dinámicamente al campo correcto
                    $campoID = $info['campo'];
                    $id = $fila[$campoID] ?? null;

                    if ($id) {
                        $query = "SELECT id_manual FROM {$info['tabla']} WHERE {$info['campo']} = :id";
                        $stmtManual = $conexion->prepare($query);
                        $stmtManual->bindParam(':id', $id);
                        $stmtManual->execute();
                        $idManual = $stmtManual->fetchColumn();
                        if ($idManual) {
                            $fila['id_manual'] = $idManual;
                        }
                    }

                    break;
                }
            }

        }

        return [
            'exito' => true,
            'datos' => $resultados,
            'total' => $totalRegistros,
            'pagina' => $pagina,
            'porPagina' => $porPagina
        ];
    } catch (Exception $e) {
        error_log("Error al filtrar reportes por oficina: " . $e->getMessage());
        return [
            'exito' => false,
            'error' => $e->getMessage()
        ];
    }
}






}

?>
