<?php 
require_once 'conexiondb.php';
class reportesModelo{

    public static function mostrarReportes() {
        try {
            $conexion = DB::conectar();
            $consulta = "
                SELECT r.*, ui.nombre
                FROM reportes_entradas r
                INNER JOIN usuarios_info ui ON r.ci = ui.ci
                ORDER BY r.fecha_entrada DESC
            ";
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return ['exito' => true, 'datos' => $datos];
        } catch (PDOException $e) {
            return ['exito' => false, 'mensaje' => $e->getMessage()];
        }
    }

    public static function mostrarReportesAcciones() {
        try {
            $conexion = DB::conectar();
            $consulta = "
                SELECT ra.*, ui.nombre
                FROM reportes_acciones ra
                INNER JOIN usuarios_info ui ON ra.ci = ui.ci
                ORDER BY ra.fecha DESC
            ";
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return ['exito' => true, 'datos' => $datos];
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
                $consulta = "DELETE FROM usuarios WHERE ci = :ci";
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam(':ci', $ci, PDO::PARAM_INT);
                $stmt->execute();

                return ['exito' => true];
            } catch (PDOException $e) {
                return ['exito' => false, 'mensaje' => $e->getMessage()];
            }
        }


}

?>
