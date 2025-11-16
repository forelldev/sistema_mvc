<?php 
require_once 'modelo/loginModel.php';
require_once 'modelo/notificacionesModelo.php';
require_once 'modelo/procesarModelo.php';
class LoginControl {
    public function ingresar() {
        // Verifica si la sesión ya está iniciada antes de llamar a session_start
        $ci = $_POST['ci'] ?? null;
        $clave = $_POST['clave'] ?? null;
        $respuesta = UserModel::verificarCredenciales($ci, $clave);
        if ($respuesta['status'] === 'ok') {
            $usuarioDatos = $respuesta['usuario'];
            $_SESSION['ci'] = $usuarioDatos['ci'];
            $_SESSION['id_rol'] = $usuarioDatos['id_rol'];
            $_SESSION['rol'] = UserModel::rol($_SESSION['id_rol']);
            $_SESSION['sesion'] = $usuarioDatos['sesion'];
            date_default_timezone_set('America/Caracas');
            $fecha_entrada = date('Y-m-d H:i:s');
            $_SESSION['id_sesion'] = UserModel::registrarEntrada($usuarioDatos['ci'],$fecha_entrada);
            header('Location: '.BASE_URL.'/main');
            exit;
        } else {
            // Redirigir con msj personalizado
            $msj = urlencode($respuesta['msj']);
            header('Location: '.BASE_URL.'/?msj=' . $msj);
            exit;
        }
    }

    public function index() {
        if (isset($_SESSION['ci'])) {
            header('Location: '.BASE_URL.'/main');
            exit;
        }
        require_once 'vistas/login.php';
    }

    public function main() {
        if (!isset($_SESSION['ci'])) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }
        $datos = [];
        $msj = null;
        // Notificaciones generales (solicitud_ayuda)
        $res = UserModel::ultima_entrada($_SESSION['ci']);
        if($res['exito']){
            $dia = $res['datos'];
            $dia_ordenado = date('d-m-Y', strtotime($dia));
            $datos = UserModel::solicitante($_SESSION['ci']);
            if($datos){
                $nombre = $datos['nombre']. ' '.$datos['apellido'];
            }
        }
        require_once 'vistas/main.php';
    }

    public function obtenerNotificacionesAjax() {
        if (!isset($_SESSION['ci'])) {
            echo json_encode(['exito' => false, 'mensaje' => 'No autenticado']);
            return;
        }

        $datos = [];
        $rol = $_SESSION['id_rol'] ?? null;

        // Notificaciones generales
        $notificaciones = Notificaciones::mostrarNotificaciones($rol);
        if ($notificaciones['exito'] && !empty($notificaciones['datos'])) {
            $datos = $notificaciones['datos'];
        }

        // Despacho (rol 2, 3, 4)
        if (in_array($rol, [2, 3, 4])) {
            $despacho = Notificaciones::mostrar_notificaciones_despacho($rol);
            if ($despacho['exito'] && !empty($despacho['datos']['despacho'])) {
                $datos['despacho'] = $despacho['datos']['despacho'];
            }
        }

        // Desarrollo (rol 4)
        if (in_array($rol, [4])) {
            $desarrollo = Notificaciones::mostrar_notificaciones_desarrollo();
            if ($desarrollo['exito'] && !empty($desarrollo['datos']['desarrollo'])) {
                $datos['desarrollo'] = $desarrollo['datos']['desarrollo'];
            }
        }

        // Validación final: si no hay datos, devolver error
        if (empty($datos)) {
            echo json_encode(['exito' => false, 'mensaje' => 'No hay notificaciones disponibles']);
        } else {
            echo json_encode(['exito' => true, 'datos' => $datos]);
        }
    }


    public function logout() {
        if (isset($_SESSION['ci'])) {
            date_default_timezone_set('America/Caracas');
            $ci = $_SESSION['ci'];
            $id = $_SESSION['id_sesion'] ?? null;
            $fecha_salida = date('Y-m-d H:i:s');
            // Registrar salida si hay ID de sesión
            if ($id) {
                UserModel::registrarSalida($id, $fecha_salida);
            }
            // Registrar cierre de sesión
            UserModel::logOut($ci);
            // Cerrar sesión de forma segura
            if (session_status() === PHP_SESSION_ACTIVE) {
                session_unset();      // Elimina todas las variables de sesión
                session_destroy();    // Destruye la sesión actual
                session_write_close(); // Libera el archivo de sesión
            }
            // Redirigir al inicio
            header('Location: ' . BASE_URL . '/');
            exit;
        }
    }

public function validarSesionAjax() {
    header('Content-Type: application/json');
    if (isset($_SESSION['ci'])) {
        $activa = UserModel::sesionValidar($_SESSION['ci']);

        if ($activa) {
            echo json_encode(['sesionActiva' => true]);
        } else {
            date_default_timezone_set('America/Caracas');
            $fecha_salida = date('Y-m-d H:i:s');
            $id = $_SESSION['id_sesion'];
            UserModel::registrarSalida($id,$fecha_salida);
            // ⚠️ Sesión marcada como inactiva en la base de datos
            session_unset();      // Elimina variables de sesión
            session_destroy();    // Destruye la sesión
            setcookie(session_name(), '', time() - 3600, '/'); // Elimina cookie
            echo json_encode(['sesionActiva' => false]);
        }
    } else {
        // No hay sesión en PHP
        session_destroy();
        echo json_encode(['sesionActiva' => false]);
    }
}
            // MÉTODOS DE REGISTRO
    public static function registro() {
        $ci = $_POST['ci'] ?? null;
        $correo = $_POST['correo'] ?? null;
        $clave = $_POST['clave'] ?? null;
        $nombre = $_POST['nombre'] ?? null;
        $apellido = $_POST['apellido'] ?? null;
        $id_rol = $_POST['id_rol'] ?? null;
        $sesion = 'False'; // Valor inicial de sesión

        $msj = '';

        if ($ci && $clave && $nombre && $apellido && $id_rol) {
            $claveHash = password_hash($clave, PASSWORD_DEFAULT);
            $resultado = UserModel::crearCuenta($ci,$correo, $claveHash, $nombre, $apellido, $id_rol, $sesion);
                if (str_starts_with($resultado, 'error_sql:')) {
                    $msj = "❌ Error SQL: " . substr($resultado, strlen('error_sql:'));
                }
                else{
                    switch ($resultado) {
                        case 'exito':
                            $msj = "✅ Usuario registrado correctamente.";
                            break;
                        case 'usuario_existente':
                            $msj = "❌ Error: el usuario con esta Cédula de Identidad ya existe.";
                            break;
                        case 'limite_superado':
                            $msj = "🚫 Error: se ha alcanzado el límite de usuarios para este rol.";
                            break;
                        case 'rol_invalido':
                            $msj = "⚠️ Error: el rol seleccionado no es válido.";
                            break;
                        default:
                            $msj = "❌ Error desconocido al registrar el usuario.";
                            break;
                        }
                    }
        } else {
            $msj = "⚠️ Error: datos incompletos.";
        }
        // Mostrar la vista con el msj
        require_once 'vistas/registro.php';
    }


        public static function registroIndex() {
            if (!isset($_SESSION['ci'])) {
            header('Location: '.BASE_URL.'/');
            exit;
        }
            require_once 'vistas/registro.php';
        }

        public static function solicitud_notificacion() {
            if (!isset($_GET['id_doc'])) {
                $msj = 'Ocurrió un error al recibir los datos (GET)';
                header("Location: " . BASE_URL . "/main");
                exit;
            }
            date_default_timezone_set('America/Caracas');
            $id_doc = $_GET['id_doc'];
            $id_name = $_GET['id_name'] ?? null;
            $tabla = $_GET['tabla'] ?? null;
            $rol = isset($_SESSION['id_rol']) ? (int)$_SESSION['id_rol'] : null;

            // Función auxiliar para validar acceso por rol y estado
            function tieneAcceso($estado, $rol) {
                $mapa = [
                    'En espera del documento físico para ser procesado 0/3' => [1, 4],
                    'En Proceso 1/3' => [1, 4],
                    'En Proceso 2/3' => [2, 4],
                    'En Proceso 3/3 (Sin entregar)' => [3, 4],
                    'En espera del documento físico para ser procesado 0/2' => [1, 4],
                    'En Proceso 1/2' => [1, 4],
                    'En Proceso 2/2 (Sin entregar)' => [1, 3, 4],
                    'Solicitud Finalizada (Ayuda Entregada)' => [4],
                    'En Revisión 1/2' => [2, 4],
                    'Aprobado 2/2' => [3,4]
                ];
                return isset($mapa[$estado]) && in_array($rol, $mapa[$estado]);
            }

            switch ($id_name) {
                case 'id_doc':
                    $notificaciones = Notificaciones::mostrar_notis($id_doc);
                    if ($notificaciones['exito']) {
                        $datos = $notificaciones['datos'];
                        foreach ($datos as $fila) {
                            $estado = $fila['estado'] ?? '';
                            if (!tieneAcceso($estado, $rol)) {
                                header('Location: ' . BASE_URL . '/main?msj=La solicitud ya ha sido procesada!');
                                exit;
                            }
                            if (isset($fila['visto']) && $fila['visto'] == 0) {
                                Notificaciones::marcar_vista_uno($id_doc, $id_name, $tabla);
                                $fecha = date('Y-m-d H:i:s');
                                $accion = "Hizo click sobre la notificación, marcó visto (General)";
                                Procesar::registrarReporte($id_doc,$fecha,$accion,$_SESSION['ci']);
                                break;
                            }
                        }
                    } else {
                        $msj = 'Ocurrió un error ' . $notificaciones['mensaje'];
                    }

                    $acciones = [
                        'En espera del documento físico para ser procesado 0/3' => 'Aprobar para su procedimiento',
                        'En Proceso 1/3' => 'Enviar a despacho',
                        'En Proceso 2/3' => 'Enviar a Administración',
                        'En Proceso 3/3 (Sin entregar)' => 'Finalizar Solicitud (Se Entregó la ayuda)',
                        'Solicitud Finalizada (Ayuda Entregada)' => 'Reiniciar en caso de algún error'
                    ];
                    require_once 'vistas/solicitud.php';
                    break;

                case 'id_des':
                    $notificaciones = Notificaciones::mostrar_notis_desarrollo($id_doc);
                    if ($notificaciones['exito']) {
                        $datos = $notificaciones['datos'];
                        foreach ($datos as $fila) {
                            $estado = $fila['estado'] ?? '';
                            if (!tieneAcceso($estado, $rol)) {
                                header('Location: ' . BASE_URL . '/main?msj=La solicitud ya ha sido procesada');
                                exit;
                            }
                            if (isset($fila['visto']) && $fila['visto'] == 0) {
                                Notificaciones::marcar_vista_uno($id_doc, $id_name, $tabla);
                                $fecha = date('Y-m-d H:i:s');
                                $accion = "Hizo click sobre la notificación, marcó visto (Desarrollo)";
                                Procesar::registrarReporte($id_doc,$fecha,$accion,$_SESSION['ci']);
                                break;
                            }
                        }
                    } else {
                        $msj = 'Ocurrió un error ' . $notificaciones['mensaje'];
                    }

                    $acciones = [
                        'En espera del documento físico para ser procesado 0/2' => 'Aprobar para su procedimiento',
                        'En Proceso 1/2' => 'Aprobar Ayuda',
                        'En Proceso 2/2 (Sin entregar)' => 'Finalizar Solicitud (Se entregó la ayuda)',
                        'Solicitud Finalizada (Ayuda Entregada)' => 'Reiniciar en caso de algún error'
                    ];
                    require_once 'vistas/solicitud_notificacion_desarrollo.php';
                    break;

                case 'id_despacho':
                    $notificaciones = Notificaciones::mostrar_notis_despacho($id_doc);
                    if ($notificaciones['exito']) {
                        $datos = $notificaciones['datos'];
                        foreach ($datos as $fila) {
                            $estado = $fila['estado'] ?? '';
                            if (!tieneAcceso($estado, $rol)) {
                                header('Location: ' . BASE_URL . '/main?msj=La solicitud ya ha sido procesada!');
                                exit;
                            }
                            if (isset($fila['visto']) && $fila['visto'] == 0) {
                                Notificaciones::marcar_vista_uno($id_doc, $id_name, $tabla);
                                $fecha = date('Y-m-d H:i:s');
                                $accion = "Hizo click sobre la notificación, marcó visto (Despacho)";
                                Procesar::registrarReporte($id_doc,$fecha,$accion,$_SESSION['ci']);
                                break;
                            }
                        }
                    } else {
                        $msj = 'Ocurrió un error ' . $notificaciones['mensaje'];
                    }

                    $acciones = [
                        'En Revisión 1/2' => 'Enviar a Administración',
                        'Aprobado 2/2' => 'Finalizar Solicitud (Se entregó la ayuda)',
                        'Solicitud Finalizada (Ayuda Entregada)' => 'Reiniciar en caso de algún error'
                    ];
                    require_once 'vistas/solicitud_notificacion_despacho.php';
                    break;

                default:
                    $res = Notificaciones::mostrar_notis($id_doc);
                    if ($res['exito']) {
                        $datos = $res['datos'];
                    } else {
                        $msj = 'Ocurrió un error en la urgencia';
                    }
                    require_once 'vistas/solicitud_urgencia.php';
                    break;
            }
        }


        public static function marcar_vistas(){
            Notificaciones::marcar_vista($_SESSION['id_rol']);
            // Capturar el resultado de las notificaciones
            $notificaciones = Notificaciones::mostrarNotificaciones($_SESSION['id_rol']);

            // Validar si hubo error
            if ($notificaciones === false || !isset($notificaciones['exito'])) {
                echo 'false error';
                return;
            }
            // Extraer los datos si la búsqueda fue exitosa
            $datos = $notificaciones['exito'] ? $notificaciones['datos'] : [];
            require_once 'vistas/main.php';
        }

        

        public static function recuperacion_clave(){
            require_once 'vistas/recuperacion_clave.php';
        }

        public static function recuperar_clave(){
            if (isset($_POST['correo'])) {
                $correo = $_POST['correo'];
                $resultado = UserModel::verificar_correo($correo);
                if ($resultado && $resultado['existe']) {
                    $_SESSION['ci_recuperacion'] = $resultado['ci_recuperacion']; // Guardar la CI si quieres usarla después
                    $generar_codigo = UserModel::generar_codigo($_SESSION['ci_recuperacion']);
                    if(isset($generar_codigo['retorno']) && $generar_codigo['retorno'] == 'retorno'){
                        $msj = $generar_codigo['msj'];
                        require_once 'vistas/recuperar_clave.php';
                    }
                    else if($generar_codigo['success']){
                        $msj = $generar_codigo['msj'];
                        require_once 'vistas/recuperar_clave.php';
                    }
                    else{
                        $msj = $generar_codigo['msj'] ?? 'Error desconocido.';
                        require_once 'vistas/recuperacion_clave.php';
                    }
                } else {
                    $msj = 'Este correo no existe en ninguna cuenta!';
                    require_once 'vistas/recuperacion_clave.php';
                }
            }
        }


        public static function nueva_clave(){
            if(isset($_POST['codigo'])){
                $codigo = $_POST['codigo'];
                $resultado = UserModel::verificar_codigo($codigo,$_SESSION['ci_recuperacion']);
                    if($resultado['success']){
                        require_once 'vistas/nueva_clave.php';
                    }
                    else if(isset($resultado['reset']) && $resultado['reset'] == 'reset'){
                        unset($_SESSION['ci_recuperacion']);
                        $msj = $resultado['msj'];
                        header('Location: '.BASE_URL.'/?msj='.$msj);
                    }
                    else{
                        $msj = $resultado['msj'];
                        require_once 'vistas/recuperar_clave.php';
                    }
            }
            }
        

        public static function actualizar_clave(){
            if(isset($_POST['clave_nueva']) && isset($_POST['confirmar_clave'])){
                $clave_nueva = $_POST['clave_nueva'];
                $confirmar_clave = $_POST['confirmar_clave'];
                if($clave_nueva === $confirmar_clave){
                    UserModel::cambiar_clave($clave_nueva,$_SESSION['ci_recuperacion']);
                    unset($_SESSION['ci_recuperacion']);
                    require_once 'vistas/felicidades_clave.php';
                }
                else{
                    $msj = 'Las contraseñas no coinciden, vuelve a intentarlo';
                    require_once 'vistas/nueva_clave.php';
                }
            }
        }

        public static function config_user(){
            $ci = $_SESSION['ci'] ?? null;
            $res = UserModel::datos_usuario($ci);
            if($res['exito']){
                $datos = $res['datos'];
            }
            else{
                $msj = 'No se ha encontrado al usuario';
            }
            require_once 'vistas/config_user.php';
        }

        public static function configurar_usuario(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $res = UserModel::config_usuario($_POST);
                if($res['exito']){
                    $msj = 'Los datos se han cambiado con éxito!';
                    header("Location: ".BASE_URL."/main?msj=$msj");
                }
                else{
                    $msj = 'Ocurrió un error:'.$res['error'];
                }
            }   
            else{
                $msj = 'No se recibió POST';
            }
        }

        public static function config_avanzada(){
            $ci = $_SESSION['ci'] ?? null;
            $res = UserModel::datos_avanzada($ci);
            if($res['exito']){
                $datos = $res['datos'];
            }
            else{
                $msj = 'No se ha encontrado al usuario';
            }
            require_once 'vistas/config_avanzada.php';
        }

        public static function avanzada_codigo() {
            header('Content-Type: application/json');

            $res = UserModel::generar_codigo_temporal();

            echo json_encode([
                'success' => $res['exito'],
                'codigo' => $res['codigo'] ?? null,
                'msj' => $res['msj']
            ]);
        }

        public static function verificar_avanzada() {
            header('Content-Type: application/json');

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                echo json_encode(['success' => false, 'msj' => 'No se recibió POST']);
                return;
            }

            $ci_actual = $_SESSION['ci'] ?? null;
            $ci_nuevo = $_POST['ci'] ?? null;
            $nueva_clave = $_POST['nueva_clave'] ?? null;
            $correo = $_POST['correo'] ?? null;

            if (!$ci_actual || !$ci_nuevo || !$nueva_clave || !$correo) {
                echo json_encode(['success' => false, 'msj' => 'Faltan datos obligatorios']);
                return;
            }

            $res = UserModel::actualizar_configuracion_avanzada($ci_actual, $ci_nuevo, $nueva_clave, $correo);

            echo json_encode([
                'success' => $res['exito'],
                'msj' => $res['msj']
            ]);
        }

       public static function api_chat() {
            header('Content-Type: application/json');

            try {
                $input = json_decode(file_get_contents('php://input'), true);
                $mensaje = $input['mensaje'] ?? '';

                if (!$mensaje) {
                    echo json_encode(['respuesta' => 'Mensaje vacío.']);
                    return;
                }

                $apiKey = 'SHEt6LzRzpZay5KGvsV6fVeY7yAV8xsPjLZJtLzs'; // reemplaza con tu clave real

                $payload = json_encode([
                    'message' => $mensaje,
                    'model' => 'command-a-03-2025',
                    'temperature' => 0.7,
                    'chat_history' => [],
                    'stream' => false
                ]);

                $ch = curl_init('https://api.cohere.ai/v1/chat');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $apiKey
                ]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curlError = curl_error($ch);
                curl_close($ch);

                if ($curlError) {
                    echo json_encode(['respuesta' => 'Error de conexión: ' . $curlError]);
                    return;
                }

                $data = json_decode($response, true);

                if ($httpCode !== 200) {
                    $errorMsg = $data['message'] ?? 'Error desconocido de Cohere';
                    echo json_encode(['respuesta' => 'Error de Cohere: ' . $errorMsg]);
                    return;
                }

                if (!isset($data['text'])) {
                    echo json_encode(['respuesta' => 'Respuesta inesperada de la IA.']);
                    return;
                }

                echo json_encode(['respuesta' => $data['text']]);

            } catch (Exception $e) {
                echo json_encode(['respuesta' => 'Error interno: ' . $e->getMessage()]);
            }
        }


        
    }
?>