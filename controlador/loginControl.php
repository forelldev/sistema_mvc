<?php 
require_once 'modelo/loginModel.php';
require_once 'modelo/notificacionesModelo.php';
class LoginControl {
    public function ingresar() {
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
    // Capturar el resultado de las notificaciones
    $notificaciones = Notificaciones::mostrarNotificaciones($_SESSION['id_rol']);

    // Validar si hubo error
    if ($notificaciones === false || !isset($notificaciones['exito'])) {
        echo 'false error';
        return;
    }
    // Extraer los datos si la búsqueda fue exitosa
    $datos = $notificaciones['exito'] ? $notificaciones['datos'] : [];

    // Pasar los datos a la vista
    require_once 'vistas/main.php';
}



    public function logout() {
        if(isset($_SESSION['ci'])){
            date_default_timezone_set('America/Caracas');
            $ci = $_SESSION['ci'];
            $fecha_salida = date('Y-m-d H:i:s');
            $id = $_SESSION['id_sesion'];
            UserModel::registrarSalida($id,$fecha_salida);
            UserModel::logOut($ci);
            session_unset();      // Elimina variables de sesión
            session_destroy();    // Destruye la sesión
            header('Location: '.BASE_URL.'/');
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
        $clave = $_POST['clave'] ?? null;
        $nombre = $_POST['nombre'] ?? null;
        $apellido = $_POST['apellido'] ?? null;
        $id_rol = $_POST['id_rol'] ?? null;
        $sesion = 'False'; // Valor inicial de sesión

        $msj = '';

        if ($ci && $clave && $nombre && $apellido && $id_rol) {
            $claveHash = password_hash($clave, PASSWORD_DEFAULT);
            $resultado = UserModel::crearCuenta($ci, $claveHash, $nombre, $apellido, $id_rol, $sesion);
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

        public static function solicitud_notificacion(){
            if(isset($_GET['id_doc'])){
                $id_doc = $_GET['id_doc'];
                $notificaciones = Notificaciones::mostrar_notis($id_doc);
                // Validar si hubo error
                if ($notificaciones === false || !isset($notificaciones['exito'])) {
                    echo 'false error';
                    return;
                }
                // Extraer los datos si la búsqueda fue exitosa
                $datos = $notificaciones['exito'] ? $notificaciones['datos'] : [];
                $acciones = [
                    'En espera del documento físico para ser procesado 0/3' => 'Aprobar para su procedimiento',
                    'En Proceso 1/3' => 'Enviar a despacho',
                    'En Proceso 2/3' => 'Enviar a Administración',
                    'En Proceso 3/3 (Sin entregar)' => 'Finalizar Solicitud (Se Entregó la ayuda)',
                    'Solicitud Finalizada (Ayuda Entregada)' => 'Reiniciar en caso de algún error'
                ];
                // Pasar los datos a la vista
                require_once 'vistas/solicitud.php';

            }
        }
        public static function marcar_vistas(){
            Notificaciones::marcar_vista();
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
    }
?>