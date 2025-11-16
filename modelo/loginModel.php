<?php 
require_once 'conexiondb.php';
require_once 'correoModelo.php';
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
                $actualizarSalida = "
                    UPDATE reportes_entradas
                    SET fecha_salida = NOW()
                    WHERE ci = :ci AND fecha_salida = '0000-00-00 00:00:00'
                ";
                $stmtSalida = $conexion->prepare($actualizarSalida);
                $stmtSalida->bindParam(':ci', $ci);
                $stmtSalida->execute();
            return ['status' => 'cerrada', 'msj' => '¡Había una sesión activa, y se cerró correctamente!'];
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
        return ['status' => 'error', 'msj' => '¡Credenciales incorrectas!'];
    }

    public static function crearCuenta($ci,$correo, $claveHash, $nombre, $apellido, $id_rol, $sesion) {
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
            $sqlInfo = "INSERT INTO usuarios_info (ci, nombre, apellido,correo) 
                        VALUES (:ci, :nombre, :apellido,:correo)";
            $stmtInfo = $conexion->prepare($sqlInfo);
            $stmtInfo->bindParam(':ci', $ci);
            $stmtInfo->bindParam(':nombre', $nombre);
            $stmtInfo->bindParam(':apellido', $apellido);
            $stmtInfo->bindParam(':correo', $correo);
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

    public static function registrarEntrada($ci,$fecha_entrada){
        $conexion = DB::conectar();
        $consulta = "INSERT INTO reportes_entradas (ci,fecha_entrada) VALUES (:ci,:fecha_entrada)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':ci',$ci);
        $stmt->bindParam(':fecha_entrada',$fecha_entrada);
        $stmt->execute();
        $id = $conexion->lastInsertId();
        return $id;
    }

    public static function registrarSalida($id,$fecha_salida){
        $conexion = DB::conectar();
        $consulta = "UPDATE reportes_entradas SET fecha_salida = :fecha_salida WHERE id = :id";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':fecha_salida',$fecha_salida);
        $stmt->execute();
    }

    public static function verificar_correo($correo){
        $conexion = DB::conectar();
        $consulta = "SELECT ci FROM usuarios_info WHERE correo = :correo";
        $cons = $conexion->prepare($consulta);
        $cons->bindParam(':correo', $correo);
        $cons->execute();

        if ($cons->rowCount() > 0) {
            $resultado = $cons->fetch(PDO::FETCH_ASSOC);
            return ['existe' => true, 'ci_recuperacion' => $resultado['ci']];
        } else {
            return ['existe' => false];
        }
    }



   public static function generar_codigo($ci){
    $conexion = DB::conectar();

    // Verificar si ya existe un intento de recuperación
    $verificar = $conexion->prepare("SELECT intentos FROM usuarios_recuperacion WHERE ci = :ci");
    $verificar->bindParam(':ci', $ci);
    $verificar->execute();

    if ($verificar->rowCount() > 0) {
        $datos = $verificar->fetch(PDO::FETCH_ASSOC);
        $intentos = $datos['intentos'];
        $msj = "Ya hay un intento de recuperación! te quedan $intentos intentos.";
        return ['success' => false, 'msj' => $msj, 'retorno' => 'retorno'];
    }

    // Obtener correo y nombre desde usuarios_info
    $datos_usuario = self::obtener_datos_por_ci($ci);
    if (!$datos_usuario) {
        return ['success' => false, 'msj' => 'No se encontró el usuario con esa CI.'];
    }
    $correo = $datos_usuario['correo'];
    $nombre = $datos_usuario['nombre'];

    // Generar código único
    do {
        $codigo = rand(100000, 999999);
        $check = $conexion->prepare("SELECT 1 FROM usuarios_recuperacion WHERE codigo = :codigo");
        $check->bindParam(':codigo', $codigo);
        $check->execute();
    } while ($check->rowCount() > 0);

    // Registrar intento
    $intentos = 3;
    $insertar = $conexion->prepare("INSERT INTO usuarios_recuperacion (ci, codigo, intentos) VALUES (:ci, :codigo, :intentos)");
    $insertar->bindParam(':ci', $ci);
    $insertar->bindParam(':codigo', $codigo);
    $insertar->bindParam(':intentos', $intentos);
    $insertar->execute();

    // Enviar el código por correo
    $res = Correo::correoClave($correo, $nombre, $codigo);

    if ($res) {
        return ['success' => true, 'msj' => 'Se ha enviado un código a tu correo!'];
    } else {
        return ['success' => false, 'msj' => 'Error al enviar el correo.'];
    }
}



    public static function obtener_datos_por_ci($ci){
        $conexion = DB::conectar();
        $consulta = "SELECT correo, nombre FROM usuarios_info WHERE ci = :ci";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':ci', $ci);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public static function verificar_codigo($codigo, $ci){
        $conexion = DB::conectar();

        // Verificar si el código existe para ese CI
        $consulta = "SELECT * FROM usuarios_recuperacion WHERE codigo = :codigo AND ci = :ci";
        $cons = $conexion->prepare($consulta);
        $cons->bindParam(':codigo', $codigo);
        $cons->bindParam(':ci', $ci);
        $cons->execute();

        if ($cons->rowCount() > 0) {
            // Código válido, eliminar el intento
            $eliminar = $conexion->prepare("DELETE FROM usuarios_recuperacion WHERE ci = :ci");
            $eliminar->bindParam(':ci', $ci);
            $eliminar->execute();

            return ['success' => true];
        } else {
            // Buscar intentos restantes por CI
            $buscar = $conexion->prepare("SELECT intentos FROM usuarios_recuperacion WHERE ci = :ci");
            $buscar->bindParam(':ci', $ci);
            $buscar->execute();

            if ($buscar->rowCount() > 0) {
                $datos = $buscar->fetch(PDO::FETCH_ASSOC);
                $intentos = $datos['intentos'];

                // Si los intentos son 0, eliminar el registro
                if ($intentos <= 1) {
                    $borrar = $conexion->prepare("DELETE FROM usuarios_recuperacion WHERE ci = :ci");
                    $borrar->bindParam(':ci', $ci);
                    $borrar->execute();

                    return ['success' => false, 'msj' => 'Se agotaron los intentos. Debes iniciar una nueva recuperación.', 'reset' => 'reset'];
                }

                // Reducir intentos en 1
                $nuevo_intento = $intentos - 1;
                $actualizar = $conexion->prepare("UPDATE usuarios_recuperacion SET intentos = :nuevo_intento WHERE ci = :ci");
                $actualizar->bindParam(':nuevo_intento', $nuevo_intento);
                $actualizar->bindParam(':ci', $ci);
                $actualizar->execute();

                $msj = ($nuevo_intento == 1)
                    ? 'No es el código, te queda un último intento'
                    : "No es el código, te quedan $nuevo_intento intentos.";

                return ['success' => false, 'msj' => $msj];
            } else {
                return ['success' => false, 'msj' => 'No hay intento de recuperación activo.'];
            }
        }
    }

    public static function cambiar_clave($clave, $ci){
        $conexion = DB::conectar();

        // Hashear la nueva contraseña
        $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $consulta = "UPDATE usuarios SET clave = :clave WHERE ci = :ci";
        $cons = $conexion->prepare($consulta);
        $cons->bindParam(':clave', $clave_hash);
        $cons->bindParam(':ci', $ci);
        $cons->execute();

        // Eliminar cualquier intento de recuperación activo
        $borrar = $conexion->prepare("DELETE FROM usuarios_recuperacion WHERE ci = :ci");
        $borrar->bindParam(':ci', $ci);
        $borrar->execute();
    }

    public static function datos_usuario($ci) {
        $db = DB::conectar();
        $sql = "SELECT nombre, apellido FROM usuarios_info WHERE ci = :ci";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ci', $ci);

        if ($stmt->execute()) {
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($datos) {
                return ['exito' => true, 'datos' => $datos];
            } else {
                return ['exito' => false, 'error' => 'Usuario no encontrado'];
            }
        } else {
            return ['exito' => false, 'error' => 'Error en la consulta'];
        }
    }

    public static function config_usuario($post) {
        $db = DB::conectar();
        $ci = $_SESSION['ci'] ?? null;
        $nombre = trim($post['nombre'] ?? '');
        $apellido = trim($post['apellido'] ?? '');

        if (!$ci || !$nombre || !$apellido) {
            return ['exito' => false, 'error' => 'Datos incompletos'];
        }

        $sql = "UPDATE usuarios_info SET nombre = :nombre, apellido = :apellido WHERE ci = :ci";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':ci', $ci);

        if ($stmt->execute()) {
            return ['exito' => true];
        } else {
            return ['exito' => false, 'error' => 'No se pudo actualizar'];
        }
    }

     public static function datos_avanzada($ci) {
        $db = DB::conectar();
        $sql = "SELECT u.ci,ui.correo FROM usuarios u LEFT JOIN usuarios_info ui ON u.ci = ui.ci WHERE u.ci = :ci";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ci', $ci);
        if ($stmt->execute()) {
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($datos) {
                return ['exito' => true, 'datos' => $datos];
            } else {
                return ['exito' => false, 'error' => 'Usuario no encontrado'];
            }
        } else {
            return ['exito' => false, 'error' => 'Error en la consulta'];
        }
    }

    public static function generar_codigo_temporal() {
        $ci = $_SESSION['ci'] ?? null;
        if (!$ci) return ['exito' => false, 'msj' => 'No se encontró CI en sesión'];

        $db = DB::conectar();
        $sql = "SELECT nombre, correo FROM usuarios_info WHERE ci = :ci";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ci', $ci);
        if (!$stmt->execute()) return ['exito' => false, 'msj' => 'Error en la consulta'];

        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$datos) return ['exito' => false, 'msj' => 'Usuario no encontrado'];

        $codigo = rand(100000, 999999);
        $correo = $datos['correo'];
        $nombre = $datos['nombre'];

        $enviado = Correo::correoEdit($correo, $nombre, $codigo);

        return [
            'exito' => $enviado,
            'codigo' => $enviado ? $codigo : null,
            'msj' => $enviado ? 'Se ha enviado un código a tu correo electrónico' : 'Error al enviar el correo'
        ];
    }


    public static function config_avanzada($post) {
            $db = DB::conectar();
            $ci = $_SESSION['ci'] ?? null;
            $nombre = trim($post['nombre'] ?? '');
            $apellido = trim($post['apellido'] ?? '');

            if (!$ci || !$nombre || !$apellido) {
                return ['exito' => false, 'error' => 'Datos incompletos'];
            }

            $sql = "UPDATE usuarios_info SET nombre = :nombre, apellido = :apellido WHERE ci = :ci";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':ci', $ci);

            if ($stmt->execute()) {
                return ['exito' => true];
            } else {
                return ['exito' => false, 'error' => 'No se pudo actualizar'];
            }
        }

   public static function actualizar_configuracion_avanzada($ci_actual, $ci_nuevo, $nueva_clave, $correo) {
    $db = DB::conectar();

    // Hashear la nueva clave
    $clave_final = password_hash($nueva_clave, PASSWORD_DEFAULT);

    try {
        $db->beginTransaction();

        // Actualizar tabla usuarios (ci y clave)
        $updateUsuarios = $db->prepare("UPDATE usuarios SET ci = :nuevo_ci, clave = :clave WHERE ci = :ci_actual");
        $updateUsuarios->bindParam(':nuevo_ci', $ci_nuevo);
        $updateUsuarios->bindParam(':clave', $clave_final);
        $updateUsuarios->bindParam(':ci_actual', $ci_actual);
        $okUsuarios = $updateUsuarios->execute();

        // Actualizar tabla usuarios_info (correo)
        $updateInfo = $db->prepare("UPDATE usuarios_info SET correo = :correo WHERE ci = :ci_actual");
        $updateInfo->bindParam(':correo', $correo);
        $updateInfo->bindParam(':ci_actual', $ci_actual);
        $okInfo = $updateInfo->execute();

        if ($okUsuarios && $okInfo) {
            $db->commit();

            if ($ci_nuevo !== $ci_actual) {
                $_SESSION['ci'] = $ci_nuevo;
            }

            return ['exito' => true, 'msj' => 'Datos actualizados correctamente'];
        } else {
            $db->rollBack();
            return ['exito' => false, 'msj' => 'No se pudo actualizar todos los datos'];
        }
    } catch (PDOException $e) {
        $db->rollBack();
        return ['exito' => false, 'msj' => 'Error en la base de datos: ' . $e->getMessage()];
    }
}

    public static function ultima_entrada($ci) {
    try {
        $db = DB::conectar(); // Asegúrate de tener tu clase de conexión
        $sql = "SELECT fecha_salida 
                FROM reportes_entradas 
                WHERE ci = :ci AND fecha_salida IS NOT NULL 
                ORDER BY fecha_salida DESC 
                LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ci', $ci, PDO::PARAM_STR);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return ['exito' => true, 'datos' => $resultado['fecha_salida']];
        } else {
            return ['exito' => false, 'datos' => null];
        }
    } catch (PDOException $e) {
        return ['exito' => false, 'error' => $e->getMessage()];
    }
}

    public static function solicitante($ci){
        $conexion = DB::conectar();
        $consulta = "SELECT nombre,apellido FROM usuarios_info WHERE ci = :ci";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':ci', $ci);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }





}
?>