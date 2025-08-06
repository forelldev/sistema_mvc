<?php 
    require_once 'modelo/despachoModelo.php';
    require_once 'modelo/procesarModelo.php';
    class DespachoControl{
        public static function despacho_list(){
        $resultado = Despacho::buscarLista();
        if($resultado['exito']){
            $datos = $resultado['datos'];
            $acciones = [
                'En Revisión 1/2' => 'Enviar a Administración',
                'En Proceso 2/2 (Sin entregar)' => 'Finalizar Solicitud (Se entregó la ayuda)',
                'Solicitud Finalizada (Ayuda Entregada)' => 'Reiniciar en caso de algún error'
            ];

        }
        require_once 'vistas/despacho_list.php';
    }

    public static function buscar() {
        $ci = $_POST['ci'] ?? null;
        if ($ci) {
            $data = self::obtenerDatosBeneficiario($ci);
            extract($data); // crea $data_exists, $datos_beneficiario, etc.

            require_once 'vistas/despacho_formulario.php';
        }
}
    private static function obtenerDatosBeneficiario($ci) {
        $data = [
            'datos_beneficiario' => null
        ];

        $resultado = Despacho::buscarCi($ci);
        if ($resultado['exito']) {
            $data['datos_beneficiario'] = $resultado['mostrar'];
        }

        return $data;
    }

    public static function enviarFormulario() {
            date_default_timezone_set('America/Caracas');
            $_POST['fecha'] = date('Y-m-d H:i:s');
            $_POST['ci_user'] = $_SESSION['ci'];
            $resultado = Despacho::enviarForm($_POST);
            if ($resultado['exito']) {
                header('Location: ' . BASE_URL . '/felicidades');
                date_default_timezone_set('America/Caracas');
                $fecha = date('Y-m-d H:i:s');
                $accion = 'Registró solicitud de despacho';
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
                require_once 'vistas/despacho_formulario.php';
            }
        }

        public static function procesar(){
        if(isset($_GET['id_doc'])){
            $id_doc = $_GET['id_doc'];
            $estado = $_GET['estado'];
            switch($estado){
                case 'En Revisión 1/2':
                    $estado_new = 'En Proceso 2/2 (Sin entregar)';
                    $accion = 'Envió la solicitud a Administración. (Despacho)';
                    break;
                case 'En Proceso 2/2 (Sin entregar)':
                    $estado_new = 'Solicitud Finalizada (Ayuda Entregada)';
                    $accion = 'Confirmó que se entregó la ayuda. (Despacho)';
                    break;
                case 'Solicitud Finalizada (Ayuda Entregada)':
                    $estado_new = 'En Revisión 1/2';
                    $accion = 'Reinició la solicitud. (Despacho)';
                    break;
                default:
                    $msj = 'Ocurrió un error!';
            }
            if(Procesar::despacho($id_doc,$estado_new)){
                header('Location: '.BASE_URL.'/despacho_list');
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
        require_once 'vistas/despacho_list.php';
        }

        
    }
?>