<?php 
require_once 'modelo/DesarrolloModelo.php';
require_once 'modelo/procesarModelo.php';
class DesarrolloControl {
    public static function lista (){
        $resultado = Desarrollo::mostrar_lista();
        $notificaciones = Desarrollo::notificaciones();
        $notificacion = $notificaciones['exito'] ? $notificaciones['datos'] : [];
        // Agrupar notificaciones por categoría
        $notificacionAgrupada = [];
        foreach ($notificacion as $item) {
            $tipo = $item['categoria'] ?? 'general';
            $notificacionAgrupada[$tipo][] = $item;
        }
            if($resultado['exito']){
                $datos = $resultado['datos'];
                $acciones = [
                    'En espera del documento físico para ser procesado 0/2' => 'Aprobar para su procedimiento',
                    'En Proceso 1/2' => 'Aprobar Ayuda',
                    'En Proceso 2/2 (Sin entregar)' => 'Finalizar Solicitud (Se entregó la ayuda)',
                    'Solicitud Finalizada (Ayuda Entregada)' => 'Reiniciar en caso de algún error'
                ];
            }
            require_once 'vistas/solicitudes_desarrollo.php';
        }

    public static function buscar_desarrollo(){
        require_once 'vistas/solicitudes_desarrollo_buscar.php';
    }
    public static function formulario_desarrollo() {
        $ci = $_POST['ci'] ?? null;
        if ($ci) {
            $res = Desarrollo::verificar_solicitudes($ci);
            if($res['exito']){
                $msj = 'Se han encontrado solicitudes anteriores de esta persona';
                $datos = $res['datos'];
                require_once 'vistas/solicitud_desarrollo_encontrada.php';
            }
            else{
                $data = self::obtenerDatosBeneficiario($ci);
                extract($data); // crea $data_exists, $datos_beneficiario, etc.
                // Verificar si el solicitante existe para bloquear edición
                $readonly = !empty($datos_beneficiario['solicitante']['nombre']);
                require_once 'vistas/solicitudes_desarrollo_formulario.php';
            }
        }
    }

    public static function registrar(){
        $ci = $_POST['ci'] ?? null;
        if($ci){
            $ci = $_POST['ci'];
            $data = self::obtenerDatosBeneficiario($ci);
            extract($data); // crea $data_exists, $datos_beneficiario, etc.
            $readonly = !empty($datos_beneficiario['solicitante']['nombre']);
            require_once 'vistas/solicitudes_desarrollo_formulario.php';
        }
    }

    private static function obtenerDatosBeneficiario($ci) {
        $data = [
            'datos_beneficiario' => null
        ];

        $resultado = Desarrollo::cargar_datos_solicitantes($ci);
        if ($resultado['exito']) {
            $data['datos_beneficiario'] = $resultado['mostrar'];
        }
        return $data;
    }

    public static function enviar_formulario_desarrollo() {
            date_default_timezone_set('America/Caracas');
            $_POST['fecha'] = date('Y-m-d H:i:s');
            $_POST['ci_user'] = $_SESSION['ci'];
            $resultado = Desarrollo::enviar_formulario($_POST);
            if ($resultado['exito']) {
                header('Location: ' . BASE_URL . '/felicidades_desarrollo');
                $fecha = $_POST['fecha'];
                $accion = 'Registró solicitud en Desarrollo Social';
                $id_doc = $resultado['id_des'];
                Procesar::registrarReporte($id_doc,$fecha,$accion,$_SESSION['ci']);
                exit;
            } else {
                $msj = "Error al registrar la solicitud: " . $resultado['error'];
                $ci = $_POST['ci'] ?? null;
                $data_exists = false;
                $datos_beneficiario = $_POST; // mantener datos del intento fallido
                // Rebuscar datos si es necesario
                if ($ci) {
                    $data = self::obtenerDatosBeneficiario($ci);
                    extract($data);
                }
                // Verificar si el solicitante existe para bloquear edición
                $readonly = !empty($datos_beneficiario['solicitante']['nombre']);
                require_once 'vistas/solicitudes_desarrollo_formulario.php';
            }
        }

        public static function felicidades_desarrollo(){
            require_once 'vistas/felicidades_desarrollo.php';
        }

        public static function procesar(){
        if(isset($_GET['id_des'])){
            $id_des = $_GET['id_des'];
            $estado = $_GET['estado'];
            switch($estado){
                case 'En espera del documento físico para ser procesado 0/2':
                    $estado_new = 'En Proceso 1/2';
                    $accion = 'Aprobó la solicitud para su procedimiento (Desarrollo Social)';
                    break;
                case 'En Proceso 1/2':
                    $estado_new = 'En Proceso 2/2 (Sin entregar)';
                    $accion = 'Envió la solicitud a Administración. (Desarrollo Social)';
                    break;
                case 'En Proceso 2/2 (Sin entregar)':
                    $estado_new = 'Solicitud Finalizada (Ayuda Entregada)';
                    $accion = 'Confirmó que se entregó la ayuda. (Desarrollo Social)';
                    break;
                case 'Solicitud Finalizada (Ayuda Entregada)':
                    $estado_new = 'En Proceso 1/2';
                    $accion = 'Reinició la solicitud. (Desarrollo Social)';
                    break;
                default:
                    $msj = 'Ocurrió un error!';
            }
            if(Procesar::desarrollo($id_des,$estado_new)){
                header('Location: '.BASE_URL.'/solicitudes_desarrollo');
                date_default_timezone_set('America/Caracas');
                $fecha = date('Y-m-d H:i:s');
                Procesar::registrarReporte($id_des,$fecha,$accion,$_SESSION['ci']);
                exit;
            }
            else{
                $msj = 'Ocurrió un error ejecutando la consulta de procesamiento';
            }
        }
        else{
            $msj = 'Faltan parámetros en la solicitud';
        }
        require_once 'vistas/despacho_list.php';
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
            if(Procesar::inhabilitarDespacho($id_doc,$estado,$razon)){
                header('Location: '.BASE_URL.'/inhabilitados_despacho');
                date_default_timezone_set('America/Caracas');
                $fecha = date('Y-m-d H:i:s');
                $accion = 'Inhabilitó la solicitud razón: '.$razon;
                Procesar::registrarReporte($id_doc,$fecha,$accion,$_SESSION['ci']);
                exit;
            }
            else{
                $msj = 'Ocurrió un error inesperado';
            }
        }
    }

    public static function inhabilitados_lista(){
        $resultado = Procesar::inhabilitados_listaDespacho();
        if($resultado['exito']){
            $datos = $resultado['datos'];
        }
        require_once 'vistas/inhabilitados_despacho.php';
    }

    public static function habilitar(){
        if(isset($_GET['id_doc'])){
            $estado = 'En Revisión 1/2';
            $id_doc = $_GET['id_doc'];
            $razon = '';
            if(Procesar::habilitar_solicitudDespacho($id_doc,$estado,$razon)){
                header('Location: '.BASE_URL.'/despacho_list');
                date_default_timezone_set('America/Caracas');
                $fecha = date('Y-m-d H:i:s');
                $accion = 'Habilitó la solicitud';
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
            $resultado = Procesar::edit_vistaDespacho($id_doc);
            if($resultado){
                $datos = $resultado['datos'];
            }
            else{
                $msj = 'Ocurrió un  en el precesamiento del id_doc';
            }
        }
        require_once 'vistas/editarDespacho.php';
    }

    public static function editar_solicitud(){
        date_default_timezone_set('America/Caracas');
        $direccion = 'despacho_list';
        $_POST['fecha'] = date('Y-m-d H:i:s');
        $_POST['ci_user'] = $_SESSION['ci'];
        $resultado = Procesar::editar_consultaDespacho($_POST);
            if($resultado['exito']){
                header('Location: '.BASE_URL.'/'.$direccion);
                date_default_timezone_set('America/Caracas');
                $fecha = date('Y-m-d H:i:s');
                $accion = 'Editó la solicitud de Despacho';
                Procesar::registrarReporte($id_doc,$fecha,$accion,$_SESSION['ci']);
            }
            else{
                $msj = "Error" . $resultado['error'];
            }
    }
}
?>