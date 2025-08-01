<?php 
require_once '../modelo/solicitudModelo.php';
class SolicitudControl {
    public static function lista(){

        require_once 'vistas/solicitudes_list.php';
    }

    public static function busqueda(){
        $ci = $_POST['ci'] ?? null;
        if ($ci) {
            $resultado = Solicitud::buscarCi($ci);
            if ($resultado['exito']) {
                $datos = $resultado['pnombre'];
                echo $datos['ci'];
            } else {
                $mensaje = $resultado['mensaje'];
                require 'vistas/busqueda_solicitudes.php';
            }
        }
}
}
?>