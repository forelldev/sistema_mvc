<?php 
require_once 'modelo/reportesModelo.php';
class ReportesControl{
    public static function reportes_entradas(){
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $porPagina = 10;

        $resultado = reportesModelo::mostrarReportes($pagina, $porPagina);
        if ($resultado['exito']) {
            $datos = $resultado['datos'];
            $total = $resultado['total'];
            $porPagina = $resultado['porPagina'];
            $paginaActual = $resultado['pagina'];
            $totalPaginas = ceil($total / $porPagina);
        }
        require_once 'vistas/reportes.php'; 
    }

    public static function reportes_acciones(){
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $porPagina = 10;

        $resultado = reportesModelo::mostrarReportesAcciones($pagina, $porPagina);
        if ($resultado['exito']) {
            $datos = $resultado['datos'];
            $total = $resultado['total'];
            $porPagina = $resultado['porPagina'];
            $paginaActual = $resultado['pagina'];
            $totalPaginas = ceil($total / $porPagina);
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

        // Contar usuarios actuales antes de actualizar el límite
        $conteo = reportesModelo::contarUsuariosPorRol($id_rol);
        $total_usuarios = intval($conteo['datos'][0]['total'] ?? 0);

        if ($total_usuarios > $nuevo_limite) {
            // Hay excedentes, no se actualiza el límite aún
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
        }

        // Si no hay excedentes, se actualiza el límite
        $actualizado = reportesModelo::actualizarLimite($id_rol, $nuevo_limite);
        if ($actualizado['exito']) {
            $msj = "Límite actualizado correctamente. No hay usuarios excedentes.";
        } else {
            $msj = "Error al actualizar el límite: " . $actualizado['mensaje'];
        }

        $datos = [
            'id_rol' => $id_rol,
            'nombre_rol' => $nombre_rol,
            'limite' => $nuevo_limite
        ];
        require_once 'vistas/limite_editar.php';
        return;
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

    public static function filtrar_fecha() {
        if (isset($_POST['fecha_inicio']) && isset($_POST['fecha_final'])) {
            $_POST['pagina'] = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $_POST['porPagina'] = 10;
            $resultado = reportesModelo::fecha_filtro($_POST);
            if ($resultado['exito']) {
                $datos = $resultado['datos'];
                $fecha_inicio = $_POST['fecha_inicio'];
                $fecha_final = $_POST['fecha_final'];
                $total = $resultado['total'];
                $porPagina = $resultado['porPagina'];
                $paginaActual = $resultado['pagina'];
                $totalPaginas = ceil($total / $porPagina);
                
            } else {
                $msj = "Error al filtrar solicitudes por fecha: " . $resultado['error'];
            }
        } else {
            $msj = "No está llegando el POST correctamente.";
        }
        require_once 'vistas/reportes.php';
    }

        public static function filtrar_acciones() {
            // Paginación
            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $porPagina = 10;

            // Inicializar variables para la vista
            $datos = [];
            $total = 0;
            $totalPaginas = 1;
            $paginaActual = $pagina;
            $msj = '';
            $fecha = '';
            $oficina = '';

            // Validar POST
            if (isset($_POST['fecha']) && isset($_POST['oficina'])) {
                $fecha = $_POST['fecha'];
                $oficina = $_POST['oficina'];

                // Ejecutar modelo con filtros
                $resultado = reportesModelo::filtro_acciones($fecha, $oficina, $pagina, $porPagina);

                if ($resultado['exito']) {
                    $datos = $resultado['datos'];
                    $total = $resultado['total'];
                    $porPagina = $resultado['porPagina'];
                    $paginaActual = $resultado['pagina'];
                    $totalPaginas = ceil($total / $porPagina);
                } else {
                    $msj = "Error al filtrar reportes: " . $resultado['error'];
                }
            } else {
                $msj = "Faltan parámetros para filtrar.";
            }

            // Cargar vista
            require_once 'vistas/reportes_acciones.php';
        }



}
?>