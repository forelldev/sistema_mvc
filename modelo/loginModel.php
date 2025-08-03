<?php 
require_once 'conexiondb.php';
class UserModel {
    public static function verificarCredenciales($ci, $clave){
        $conexion = DB::conectar();
        // Verificar si ese usuario ya tiene sesión activa
        $sqlSesion = "SELECT sesion FROM usuarios WHERE ci = :ci";
        $stmtSesion = $conexion->prepare($sqlSesion);
        $stmtSesion->bindParam(':ci', $ci);
        $stmtSesion->execute();
        $estadoSesion = $stmtSesion->fetchColumn();
        if ($estadoSesion === 'True') {
            // Cerrar sesión si ya estaba activa
            $cerrarSesion = "UPDATE usuarios SET sesion = 'False' WHERE ci = :ci";
            $stmtCerrar = $conexion->prepare($cerrarSesion);
            $stmtCerrar->bindParam(':ci', $ci);
            $stmtCerrar->execute();
            return ['status' => 'cerrada', 'mensaje' => '¡Había una sesión activa, y se cerró correctamente!'];
        }
        // Verificar credenciales
        $sql = 'SELECT * FROM usuarios WHERE ci = :ci';
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':ci', $ci);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado && password_verify($clave, $resultado['clave'])) {
            // Iniciar sesión
            $sesion = 'True';
            $consulta = "UPDATE usuarios SET sesion = :sesion WHERE ci = :ci";
            $cons = $conexion->prepare($consulta);
            $cons->bindParam(':sesion', $sesion);    
            $cons->bindParam(':ci', $ci);
            $cons->execute();

            return ['status' => 'ok', 'usuario' => $resultado];
        }
        return ['status' => 'error', 'mensaje' => '¡Credenciales incorrectas!'];
    }

    public static function crearCuenta($ci, $claveHash, $nombre, $apellido, $id_rol, $sesion) {
        $conexion = DB::conectar();

        // Verificar si el usuario ya existe
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE ci = :ci");
        $stmt->bindParam(':ci', $ci);
        $stmt->execute();

        if ($stmt->fetch()) {
            return 'usuario_existente';
        }

        // Verificar límite de usuarios para el rol
        $stmtLimite = $conexion->prepare("SELECT limite FROM roles WHERE id_rol = :id_rol");
        $stmtLimite->bindParam(':id_rol', $id_rol);
        $stmtLimite->execute();
        $limiteData = $stmtLimite->fetch(PDO::FETCH_ASSOC);

        if (!$limiteData) {
            return 'rol_invalido';
        }

        $limite = (int)$limiteData['limite'];

        // Contar usuarios actuales con ese rol
        $stmtContador = $conexion->prepare("SELECT COUNT(*) as total FROM usuarios WHERE id_rol = :id_rol");
        $stmtContador->bindParam(':id_rol', $id_rol);
        $stmtContador->execute();
        $totalUsuarios = (int)$stmtContador->fetch(PDO::FETCH_ASSOC)['total'];

        if ($totalUsuarios >= $limite) {
            return 'limite_superado';
        }

        try {
            // Iniciar transacción
            $conexion->beginTransaction();

            // Insertar en tabla usuarios
            $sqlUsuarios = "INSERT INTO usuarios (ci, clave, id_rol, sesion) 
                            VALUES (:ci, :clave, :id_rol, :sesion)";
            $stmtUsuarios = $conexion->prepare($sqlUsuarios);
            $stmtUsuarios->bindParam(':ci', $ci);
            $stmtUsuarios->bindParam(':clave', $claveHash);
            $stmtUsuarios->bindParam(':id_rol', $id_rol);
            $stmtUsuarios->bindParam(':sesion', $sesion);
            $stmtUsuarios->execute();

            // Insertar en tabla usuarios_info
            $sqlInfo = "INSERT INTO usuarios_info (ci, nombre, apellido) 
                        VALUES (:ci, :nombre, :apellido)";
            $stmtInfo = $conexion->prepare($sqlInfo);
            $stmtInfo->bindParam(':ci', $ci);
            $stmtInfo->bindParam(':nombre', $nombre);
            $stmtInfo->bindParam(':apellido', $apellido);
            $stmtInfo->execute();

            // Confirmar transacción
            $conexion->commit();
            return 'exito';

        } catch (PDOException $e) {
            $conexion->rollBack();
            error_log("Error al registrar usuario: " . $e->getMessage());
            return 'error_sql: ' . $e->getMessage(); // TEMPORAL para depuración
            }
    }
    
    public static function logOut($ci){
            $conexion = DB::conectar();
            $sesion = 'False';
            $consulta = "UPDATE usuarios SET sesion = :sesion WHERE ci = :ci";
            $cons = $conexion->prepare($consulta);
            $cons->bindParam(':sesion',$sesion);
            $cons ->bindParam(':ci',$ci);
            $cons->execute();
    }

    public static function sesionValidar($ci){
        $conexion = DB::conectar();
        $consulta = "SELECT sesion FROM usuarios WHERE ci = :ci";
        $cons = $conexion->prepare($consulta);
        $cons ->bindParam(':ci',$ci);
        $cons->execute();
        $estado = $cons->fetchColumn();
        // Retornar true si la sesión está activa
        return $estado === 'True';
    }

    public static function rol($id_rol){
        $conexion = DB::conectar();
        $consulta = "SELECT nombre_rol FROM roles WHERE id_rol = :id_rol";
        $cons = $conexion->prepare($consulta);
        $cons->bindParam(':id_rol',$id_rol);
        $cons->execute();
        $rol = $cons->fetchColumn();
        return $rol;
    }
}
?>