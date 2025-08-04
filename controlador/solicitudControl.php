<?php 
require_once 'modelo/solicitudModelo.php';
require_once 'modelo/procesarModelo.php';
class SolicitudControl {
    public static function lista(){
        $resultado = Solicitud::buscarLista();
        if($resultado['exito']){
            $datos = $resultado['datos'];
            $acciones = [
                'En espera del documento físico para ser procesado 0/3' => 'Aprobar para su procedimiento',
                'En Proceso 1/3' => 'Enviar a despacho',
                'En Proceso 2/3' => 'Finalizar Solicitud (Enviar a Administración)',
                'Finalizado 3/3' => 'Reiniciar en caso de algún error'
            ];

        }
        require_once 'vistas/solicitudes_list.php';
    }

    public static function busquedaVista(){
        require_once 'vistas/busqueda.php';
    }

    public static function buscar() {
    $ci = $_POST['ci'] ?? null;
    if ($ci) {
        $data = self::obtenerDatosBeneficiario($ci);
        extract($data); // crea $data_exists, $datos_beneficiario, etc.

        require_once 'vistas/solicitud_formulario.php';
    }
}


    private static function obtenerDatosBeneficiario($ci) {
        $data = [
            'data_exists' => false,
            'datos_beneficiario' => null,
            'tiposJS' => '',
            'nombresJS' => ''
        ];

        $resultado = Solicitud::buscarCi($ci);
        if ($resultado['exito']) {
            $data['data_exists'] = true;
            $data['datos_beneficiario'] = $resultado['mostrar'];

            $tipos = [];
            $nombres = [];
            foreach ($data['datos_beneficiario']['patologia'] as $fila) {
                $tipos[] = htmlspecialchars($fila['tip_patologia']);
                $nombres[] = htmlspecialchars($fila['nom_patologia']);
            }

            $data['tiposJS'] = implode('|', $tipos);
            $data['nombresJS'] = implode('|', $nombres);
        }

        return $data;
    }

    
    public static function enviarFormulario() {
        date_default_timezone_set('America/Caracas');
        $_POST['fecha'] = date('Y-m-d H:i:s');
        $_POST['ci_user'] = $_SESSION['ci'];

        $resultado = Solicitud::enviarForm($_POST);

        if ($resultado['exito']) {
            header('Location: ' . BASE_URL . '/felicidades');
            exit;
        } else {
            $msj = "Error al registrar la solicitud: " . $resultado['error'];

            $ci = $_POST['ci'] ?? null;
            $data_exists = false;
            $datos_beneficiario = $_POST; // mantener datos del intento fallido
            $tiposJS = $_POST['tiposJS'] ?? '';
            $nombresJS = $_POST['nombresJS'] ?? '';

            // Rebuscar datos si es necesario
            if ($ci) {
                $data = self::obtenerDatosBeneficiario($ci);
                extract($data);
            }

            require_once 'vistas/solicitud_formulario.php';
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

    public static function procesar(){
        if(isset($_GET['id_doc'])){
            $id_doc = $_GET['id_doc'];
            $estado = $_GET['estado'];
            switch($estado){
                case 'En espera del documento físico para ser procesado 0/3':
                    $estado_new = 'En Proceso 1/3';        
                    break;
                case 'En Proceso 1/3':
                    $estado_new = 'En Proceso 2/3';
                    break;
                case 'En Proceso 2/3':
                    $estado_new = 'Finalizado 3/3';
                    break;
                case 'Finalizado 3/3':
                    $estado_new = 'En espera del documento físico para ser procesado 0/3';
                    break;
                default:
                    $msj = 'Ocurrió un error!';
            }
            if(Procesar::solicitud($id_doc,$estado_new)){
                header('Location: '.BASE_URL.'/solicitudes_list');
                exit;
            }
            else{
                $msj = 'Ocurrió un error ejecutando la consulta de procesamiento';
            }
        }
        else{
            $msj = 'Faltan parámetros en la solicitud';
        }
        require_once 'vistas/solicitudes_list.php';
    }

    public static function inhabilitar(){
        if(isset($_GET['id_doc'])){
            $id_doc = $_GET['id_doc'];
        }
        require_once 'vistas/inhabilitar.php';
    }
    public static function inhabilitar_solicitud(){
        if(isset($_POST['id_doc'])){
            $estado = 'Inhabilitado';
            $id_doc = $_POST['id_doc'];
            $razon = $_POST['razon'];
            if(Procesar::inhabilitar($id_doc,$estado,$razon)){
                header('Location: '.BASE_URL.'/inhabilitados_lista');
                exit;
            }
            else{
                $msj = 'Ocurrió un error inesperado';
            }
        }
    }

    public static function inhabilitados_lista(){
        $resultado = Procesar::inhabilitados_lista();
        if($resultado['exito']){
            $datos = $resultado['datos'];
        }
        require_once 'vistas/inhabilitados.php';
    }

    public static function editar(){
        if(isset($_GET['id_doc'])){
            $id_doc = $_GET['id_doc'];
            $resultado = Procesar::edit_vista($id_doc);
            if($resultado){
                $datos = $resultado['datos'];
            }
            else{
                $msj = 'Ocurrió un  en el precesamiento del id_doc';
            }
        }
        require_once 'vistas/editar.php';
    }

    public static function editar_solicitud(){
        date_default_timezone_set('America/Caracas');
        $direccion = 'solicitudes_list';
        $_POST['fecha'] = date('Y-m-d H:i:s');
        $_POST['ci_user'] = $_SESSION['ci'];
        $resultado = Procesar::editar_consulta($_POST);
            if($resultado['exito']){
                header('Location: '.BASE_URL.'/'.$direccion);
            }
            else{
                $msj = "Error" . $resultado['error'];
            }
    }
}
?>