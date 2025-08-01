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

    public static function buscar(){
        $ci = $_POST['ci'] ?? null;
        if ($ci) {
            $resultado = Solicitud::buscarCi($ci);
            if ($resultado['exito']) {
                $data_exists = true;
                $datos_beneficiario = $resultado['mostrar'];
            } else {
                $data_exists = false;
                $datos_beneficiario = null;
            }
            require_once 'vistas/solicitud_formulario.php';
        }
}


public static function enviarFormulario() {
    date_default_timezone_set('America/Caracas');
    $ci_user = $_SESSION['ci'];

    $data = [
        'id_manual' => $_POST['id_manual'],
        'descripcion' => $_POST['descripcion'],
        'categoria' => $_POST['categoria'],
        'remitente' => $_POST['remitente'],
        'observaciones' => $_POST['observaciones'] ?? "Sin observaciones",
        'fecha' => date("Y-m-d H:i:s"),

        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'fecha_nacimiento' => $_POST['fecha_nacimiento'],
        'lugar_nacimiento' => $_POST['lugar_nacimiento'],
        'edad' => $_POST['edad'],
        'estado_civil' => $_POST['estado_civil'],

        'nivel_instruc' => $_POST['nivel_instruc'],
        'profesion' => $_POST['profesion'],
        'comunidad' => $_POST['comunidad'],
        'direc_habita' => $_POST['direc_habita'],
        'estruc_base' => $_POST['estruc_base'],

        'propiedad' => $_POST['propiedad'],
        'propiedad_est' => $_POST['propiedad_est'],
        'observaciones_propiedad' => $_POST['observaciones_propiedad'] ?? "No tiene observaciones",

        'nivel_ingreso' => $_POST['nivel_ingreso'],
        'bono' => $_POST['bono'],
        'pension' => $_POST['pension'],

        'trabajo' => $_POST['trabajo1'] === "Si" ? $_POST['trabajo'] : "No tiene",
        'direccion_trabajo' => $_POST['trabajo1'] === "Si" ? $_POST['direccion_trabajo'] : "No",
        'trabaja_public' => $_POST['trabajo1'] === "Si" ? $_POST['trabaja_public'] : "No",
        'nombre_insti' => ($_POST['trabajo1'] === "Si" && $_POST['trabaja_public'] === "Si") ? $_POST['nombre_insti'] : "No",

        'ci' => $_POST['ci'],
        'telefono' => $_POST['telefono'],
        'codigo_patria' => $_POST['codigo_patria'],
        'serial_patria' => $_POST['serial_patria'],

        'nom_patologia' => $_POST['nom_patologia'] ?? ["No"],
        'tip_patologia' => $_POST['tip_patologia'] ?? ["No"],
        'tipo_ayuda' => $_POST['tipo_ayuda'],
        'ci_user' => $ci_user
    ];

    if (Solicitud::enviarForm($data)) {
        header('Location: ' . BASE_URL . '/felicidades');
    } else {
        echo "Error al registrar la solicitud.";
    }
    exit();
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