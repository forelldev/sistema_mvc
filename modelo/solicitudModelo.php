<?php 
require_once 'conexiondb.php';
class Solicitud{
    public static function buscarLista (){
        $conexion = DB::conectar();
        $consulta = "SELECT * FROM solicitud_ayuda WHERE ci = :ci";
        $busqueda = $conexion->prepare($consulta);
        $busqueda->bindParam(':ci', $ci);
        $busqueda->execute();
        $resultado = $busqueda->fetch(PDO::FETCH_ASSOC);
    }
    public static function buscarCi($ci){
        $conexion = DB::conectar();
        $consulta = "SELECT * FROM solicitantes WHERE ci = :ci";
        $busqueda = $conexion->prepare($consulta);
        $busqueda->bindParam(':ci', $ci);
        $busqueda->execute();
        $resultado = $busqueda->fetch(PDO::FETCH_ASSOC);
          if ($resultado) {
                // Usuario encontrado, devolver datos
                return [
                    'exito' => true,
                    'datos' => $resultado
                ];
            } else {
                // No se encontró el usuario
                return [
                    'exito' => false,
                    'mensaje' => 'No se encontró ningún usuario con esa cédula.'
                ];
            }
    }
}

?>