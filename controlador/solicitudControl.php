<?php 
require_once 'modelo/solicitudModelo.php';
class SolicitudControl {
    public static function lista(){
        $resultado = Solicitud::buscarLista();
        if($resultado['exito']){
            $datos = $resultado['datos'];
        }
        require_once 'vistas/solicitudes_list.php';
    }

    public static function busquedaVista(){
        require_once 'vistas/busqueda.php';
    }

    public static function buscar() {
        $ci = $_POST['ci'] ?? null;
        if ($ci) {
            $resultado = Solicitud::buscarCi($ci);
            if ($resultado['exito']) {
                $data_exists = true;
                $datos_beneficiario = $resultado['mostrar'];

                // Extraer patologías
                $tipos = [];
                $nombres = [];

                foreach ($datos_beneficiario['patologia'] as $fila) {
                    $tipos[] = htmlspecialchars($fila['tip_patologia']);
                    $nombres[] = htmlspecialchars($fila['nom_patologia']);
                }

                $tiposJS = implode('|', $tipos);
                $nombresJS = implode('|', $nombres);
            } else {
                $data_exists = false;
                $datos_beneficiario = null;
                $tiposJS = '';
                $nombresJS = '';
            }

            require_once 'vistas/solicitud_formulario.php';
        }
    }
    
    public static function enviarFormulario() {
        date_default_timezone_set('America/Caracas');
        $_POST['fecha'] = date('Y-m-d H:i:s'); // o date('Y-m-d H:i:s') si necesitas hora
        $_POST['ci_user'] = $_SESSION['ci'];
        $resultado = Solicitud::enviarForm($_POST);
        if ($resultado['exito']) {
            header('Location: '.BASE_URL.'/felicidades');
        } else {
            echo "Error al registrar la solicitud: " . $resultado['error'];
        }
    }


    public static function formulario(){
        $data_exists = false;
        $datos_beneficiario = null;
        require_once 'vistas/solicitud_formulario.php';
    }

    public static function felicidades(){
        require_once 'vistas/felicidades.php';
    }
}
?>