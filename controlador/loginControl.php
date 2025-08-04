<?php 
require_once 'modelo/loginModel.php';
class loginControl {
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
    public function main(){
        if (!isset($_SESSION['ci'])) {
            header('Location: '.BASE_URL.'/');
            exit;
        }
        require_once 'vistas/main.php';
    }

    public function logout() {
        if(isset($_SESSION['ci'])){
            $ci = $_SESSION['ci'];
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
                            $msj = "❌ Error: el usuario ya existe.";
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
    }
?>