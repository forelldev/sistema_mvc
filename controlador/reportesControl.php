<?php 
require_once 'modelo/reportesModelo.php';
class Reportes{
    public static function reportes_entradas(){
        require_once 'vistas/reportes.php';
    }

    public static function reportes_acciones(){
        require_once 'vistas/reportes_acciones.php';
    }
}
?>