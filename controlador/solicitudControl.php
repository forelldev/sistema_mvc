<?php 
require_once 'modelo/solicitudModelo.php';
require_once 'modelo/procesarModelo.php';
require_once 'modelo/DesarrolloModelo.php';
require_once 'modelo/despachoModelo.php';
class SolicitudControl {
    public static function lista(){
        $resultado = Solicitud::buscarLista();
        $datos = $resultado['exito'] ? $resultado['datos'] : [];
        // Agrupar notificaciones por categoría
        require_once 'vistas/solicitudes_list.php';
    }

    public static function busquedaVista(){
        if(isset($_GET['direccion'])){
            $direccion = true;
        }
        require_once 'vistas/busqueda.php';
    }

    public static function buscar() {
        if(isset($_POST['ci'])){
            $ci = $_POST['ci'];
            $res = Solicitud::verificar_solicitudes($ci);
            if($res['exito']){
                $msj = 'Se han encontrado solicitudes anteriores de esta persona';
                $datos = $res['datos'];
                require_once 'vistas/solicitudes_ci.php';
            }
            else{
                $resultado = Solicitud::verificar_solicitante($ci);
                if($resultado['exito']){
                    $msj = 'El solicitante ya está registrado!';
                    $data = self::obtenerDatosBeneficiario($ci);
                    extract($data); // crea $data_exists, $datos_beneficiario, etc.
                    require_once 'vistas/solicitud_formulario_cargado.php';                
                }
                else{
                    $msj = 'Registra al Solicitante';
                    require_once 'vistas/solicitud_formulario.php';
                }
                
            }
        }
    }

    public static function solicitudes_ci(){
        if(isset($_POST['ci'])){
            $ci = $_POST['ci'];
            $data = self::obtenerDatosBeneficiario($ci);
            extract($data); // crea $data_exists, $datos_beneficiario, etc.
            $msj = 'El solicitante ya está registrado!';
            require_once 'vistas/solicitud_formulario_cargado.php';
        }
        else{
            $msj = 'Ocurrió un error o el Solicitante no existe';
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            date_default_timezone_set('America/Caracas');
            $_POST['fecha'] = date('Y-m-d H:i:s');
            $_POST['ci_user'] = $_SESSION['ci'];

            $resultado = Solicitud::enviarForm($_POST);

            if ($resultado['exito']) {
                date_default_timezone_set('America/Caracas');
                $fecha = date('Y-m-d H:i:s');
                $accion = 'Creó una nueva solicitud de ayuda (General).';
                $id_doc = $resultado['id_doc'];
                Procesar::registrarReporte($id_doc,$fecha,$accion,$_SESSION['ci']);
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
            }

            require_once 'vistas/solicitud_formulario_cargado.php';
        }
        else{

            $msj = "Solicitud inválida. No se recibieron datos. (Método POST)";
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
                    $accion = 'Recibió documento físico, y aprobó para su procedimiento. (General)';
                    break;
                case 'En Proceso 1/3':
                    $estado_new = 'En Proceso 2/3';
                    $accion = 'Envió la solicitud a despacho. (General)';
                    break;
                case 'En Proceso 2/3':
                    $estado_new = 'En Proceso 3/3 (Sin entregar)';
                    $accion = 'Envió la solicitud a administración. (General)';
                    break;
                case 'En Proceso 3/3 (Sin entregar)':
                    $estado_new = 'Solicitud Finalizada (Ayuda Entregada)';
                    $accion = 'Confirmó que se entregó la ayuda. (General)';
                    break;
                case 'Solicitud Finalizada (Ayuda Entregada)':
                    $estado_new = 'En espera del documento físico para ser procesado 0/3';
                    $accion = 'Reinició el proceso de la solicitud. (General)';
                    break;
                default:
                    $msj = 'Ocurrió un error!';
            }
            if(Procesar::solicitud($id_doc,$estado_new)){
                header('Location: '.BASE_URL.'/solicitudes_list?msj=Solicitud actualizada con éxito!');
                date_default_timezone_set('America/Caracas');
                $fecha = date('Y-m-d H:i:s');
                Procesar::registrarReporte($id_doc,$fecha,$accion,$_SESSION['ci']);
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
        else{
            $msj = 'Ocurrió un error';
        }
        require_once 'vistas/inhabilitar.php';
    }

    public static function inhabilitar_solicitud(){
        if(isset($_POST['id_doc'])){
            $invalido = 1;
            $id_doc = $_POST['id_doc'];
            $razon = $_POST['razon'];
            if(Procesar::inhabilitar($id_doc,$invalido,$razon)){
                header('Location: '.BASE_URL.'/inhabilitados_lista');
                date_default_timezone_set('America/Caracas');
                $fecha = date('Y-m-d H:i:s');
                $accion = 'Inhabilitó la solicitud razón: '.$razon.' (General)';
                Procesar::registrarReporte($id_doc,$fecha,$accion,$_SESSION['ci']);
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

    public static function habilitar(){
        if(isset($_GET['id_doc'])){
            $invalido = 0;
            $id_doc = $_GET['id_doc'];
            $razon = '';
            if(Procesar::habilitar_solicitud($id_doc,$invalido,$razon)){
                header('Location: '.BASE_URL.'/solicitudes_list');
                date_default_timezone_set('America/Caracas');
                $fecha = date('Y-m-d H:i:s');
                $accion = 'Habilitó la solicitud (General)';
                Procesar::registrarReporte($id_doc,$fecha,$accion,$_SESSION['ci']);
                exit;
            }
            else{
                $msj = 'Ocurrió un error inesperado';
            }
        }
    }

    public static function editar(){
        if(isset($_GET['id_doc'])){
            $id_doc = $_GET['id_doc'];
            $resultado = Procesar::edit_vista($id_doc);
            if($resultado['exito']){
                $datos = $resultado['datos'];
            }
            else{
                $msj = 'Ocurrió un error: '.$resultado['error'];
            }
        }
        require_once 'vistas/editar.php';
    }

    public static function editar_solicitud(){
        date_default_timezone_set('America/Caracas');
        $direccion = 'solicitudes_list';
        $_POST['fecha'] = date('Y-m-d H:i:s');
        $_POST['ci_user'] = $_SESSION['ci'];
        $_POST['id_doc'] = $_SESSION['id_doc'];
        $resultado = Procesar::editar_consulta($_POST);
            if($resultado['exito']){
                $fecha = date('Y-m-d H:i:s');
                $accion = 'Editó la solicitud';
                Procesar::registrarReporte($_SESSION['id_doc'],$fecha,$accion,$_SESSION['ci']);
                unset($_SESSION['id_doc']);
                header('Location: '.BASE_URL.'/'.$direccion);
                exit;
            }
            else{
                $msj = 'Ocurrió un error: '.$resultado['error'];
                unset($_SESSION['id_doc']);
                require_once 'vistas/editar.php';
            }
    }

  public static function filtrar(){
    if(isset($_GET['filtro'])){
    $resultado = Solicitud::filtrar_solicitud($_GET['filtro'] ?? '');
    if ($resultado['exito']) {
        $datos = $resultado['datos'];
    } else {
        // Puedes redirigir, mostrar un mensaje, o cargar una vista de error
        $msj = "Error al filtrar solicitudes: " . $resultado['error'];
        // Alternativamente:
        // require_once 'vistas/error.php';
    }
    }
    else{
        $msj = 'Ocurrió un error al recibir el get';
    }
    require_once 'vistas/solicitudes_list.php';
}

    public static function filtrar_fecha() {
    if (isset($_POST['fecha_inicio']) && isset($_POST['fecha_final']) && isset($_POST['estado'])) {
        $resultado = Solicitud::fecha_filtro($_POST);
        if ($resultado['exito']) {
            $datos = $resultado['datos'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_final = $_POST['fecha_final'];
            $estado = $_POST['estado'];
        } else {
            $msj = "Error al filtrar solicitudes por fecha: " . $resultado['error'];
        }
    } else {
        $msj = "No está llegando el POST correctamente.";

        }
        require_once 'vistas/solicitudes_list.php';
    }

    public static function filtrar_busqueda() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filtro_busqueda = $_POST['filtro_busqueda'] ?? '';
            $direccion = $_POST['direccion'] ?? '';

            switch ($direccion) {
                case 'despacho':
                    $resultado = Despacho::buscar_filtro($filtro_busqueda);
                    $vista = 'vistas/despacho_list.php';
                    break;

                case 'desarrollo':
                    $resultado = Desarrollo::buscar_filtro($filtro_busqueda);
                    $vista = 'vistas/desarrollo_list.php';
                    break;

                case 'solicitud':
                default:
                    $resultado = Solicitud::buscar_filtro($filtro_busqueda);
                    $vista = 'vistas/solicitudes_list.php';
                    break;
            }

            if (isset($resultado['exito']) && $resultado['exito']) {
                $datos = $resultado['datos'];
            } else {
                $msj = $resultado['error'] ?? 'No se encontró información';
            }
        } else {
            $msj = 'Ocurrió un error recibiendo los datos (POST)';
            $vista = 'vistas/solicitudes_list.php';
        }
        require_once $vista;
    }


    public static function solicitud_urgencia(){
        if(isset($_GET['id_doc'])){
            $resultado = Solicitud::solicitud_urgencia($_GET['id_doc']);
            if($resultado['exito']){    
                $datos = $resultado['datos'];
            }
            else{
                $msj = $resultado['error'];
            }
        }
        else{
            $msj = 'No se recibió el id del documento';
        }
        require_once 'vistas/solicitud_urgencia.php';
    }

    public static function nueva_solicitud(){
        require_once 'vistas/nueva_solicitud.php';
    }

    public static function direccion_solicitud (){
        if(isset($_GET['direccion'])){
            $direccion = BASE_URL.'/nueva_solicitud';
            switch($_GET['direccion']){
                case 'solicitud':
                    header("Location: ".BASE_URL."/busqueda?direccion=".$direccion);
                    break;
                case 'desarrollo':
                    header("Location: ".BASE_URL."/buscar_desarrollo?direccion=".$direccion);
                    break;
                case 'despacho':
                    header("Location: ".BASE_URL."/despacho_busqueda?direccion=".$direccion);
                    break;
            }
        }
        else{
            $msj = 'Ocurrió un error';
            require_once 'vistas/nueva_solicitud.php';
        }
    }

    
}

?>