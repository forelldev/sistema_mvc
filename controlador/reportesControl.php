<?php 
require_once 'modelo/reportesModelo.php';
class ReportesControl{
    public static function reportes_entradas(){
        $resultado = reportesModelo::mostrarReportes();
            if($resultado['exito']){
                $datos = $resultado['datos'];
            }
        require_once 'vistas/reportes.php'; 
    }

    public static function reportes_acciones(){
        $resultado = reportesModelo::mostrarReportesAcciones();
            if($resultado['exito']){
                $datos = $resultado['datos'];
            }
        require_once 'vistas/reportes_acciones.php';
    }

    public static function limites(){
        $resultado = reportesModelo::mostrarLimites();
            if($resultado['exito']){
                $datos = $resultado['datos'];
            }
        require_once 'vistas/limites.php';
    }

    public static function edit_limite(){
        if(isset($_GET['id_rol'])){
            $id_rol = $_GET['id_rol'];
            $resultado = reportesModelo::cargarDatos($id_rol);
            if($resultado['exito']){
                $datos = $resultado['datos'];
            }
        }
        else{
            $msj = 'Ha ocurrido un error';
        }
        require_once 'vistas/limite_editar.php';
    }

    public static function consulta_limite() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_rol = $_POST['id_rol'];
            $nuevo_limite = intval($_POST['limite']);
            $nombre_rol = $_POST['nombre_rol'];

            // Actualizar el límite
            $actualizado = reportesModelo::actualizarLimite($id_rol, $nuevo_limite);

            if ($actualizado['exito']) {
                // Contar usuarios actuales
                $conteo = reportesModelo::contarUsuariosPorRol($id_rol);
                $total_usuarios = intval($conteo['datos'][0]['total'] ?? 0);

                if ($total_usuarios > $nuevo_limite) {
                    // Obtener usuarios excedentes
                    $usuarios = reportesModelo::obtenerUsuariosPorRol($id_rol);
                    $excedentes = array_slice($usuarios['datos'], 0, $total_usuarios - $nuevo_limite);

                    $datos = [
                        'id_rol' => $id_rol,
                        'nombre_rol' => $nombre_rol,
                        'limite' => $nuevo_limite
                    ];
                    $msj = "Hay usuarios excedentes. Elimina " . count($excedentes) . " cuenta(s) para cumplir el nuevo límite.";
                    require_once 'vistas/limite_editar.php';
                    return;
                } else {
                    $msj = "Límite actualizado correctamente. No hay usuarios excedentes.";
                    $datos = [
                        'id_rol' => $id_rol,
                        'nombre_rol' => $nombre_rol,
                        'limite' => $nuevo_limite
                    ];
                    require_once 'vistas/limite_editar.php';
                    return;
                }
            } else {
                $msj = "Error al actualizar el límite: " . $actualizado['mensaje'];
                require_once 'vistas/limite_editar.php';
                return;
            }
        }
        
        require_once 'vistas/limite_editar.php';
    }
    public static function eliminar_usuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ci = $_POST['ci'];
            $resultado = reportesModelo::eliminarUsuario($ci);

            if ($resultado['exito']) {
                echo "<script>alert('Usuario eliminado correctamente'); window.history.back();</script>";
            } else {
                echo "<script>alert('Error al eliminar usuario'); window.history.back();</script>";
            }
        }
    }

}
?>