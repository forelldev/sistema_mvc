<?php 
require_once 'conexiondb.php';
class Procesar{
    public static function solicitud($id_doc,$estado){
        try {
            $conexion = DB::conectar();
            $stmt = $conexion->prepare("UPDATE solicitud_ayuda SET estado = ? WHERE id_doc = ?");
            $stmt->execute([$estado, $id_doc]); 
            return true;
        } catch (PDOException $e) {
            error_log("Error al actualizar solicitud: " . $e->getMessage());
            return false;
        };
    }
    public static function inhabilitar($id_doc,$estado,$razon){
        try {
            $conexion = DB::conectar();
            $stmt = $conexion->prepare("UPDATE solicitud_ayuda SET estado = ?, razon = ? WHERE id_doc = ?");
            $stmt->execute([$estado,$razon, $id_doc]); 
            return true;
        } catch (PDOException $e) {
            error_log("Error al actualizar solicitud: " . $e->getMessage());
            return false;
        };
    }

        public static function inhabilitados_lista(){
            $conexion = DB::conectar();
            $consulta = "SELECT * FROM solicitud_ayuda WHERE estado = 'Inhabilitado' ORDER BY fecha DESC";
            $busqueda = $conexion->prepare($consulta);
            $busqueda->execute();
            $resultado = $busqueda->fetchAll(PDO::FETCH_ASSOC);
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
                        'mensaje' => 'Ocurrió un error realizando la búsqueda'
                    ];
                }
        }

        public static function edit_vista($id_doc){
            $conexion = DB::conectar();
            $stmt =$conexion->prepare("SELECT * FROM solicitud_ayuda WHERE id_doc = ?");
            $stmt->execute([$id_doc]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
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
                        'mensaje' => 'Ocurrió un error realizando la búsqueda'
                    ];
                }
        }

        public static function editar_consulta($data){
            $conexion = DB::conectar();
            try{
            $camposObligatorios = [
                'id_doc','id_manual','descripcion','ci','tipo_ayuda','categoria','remitente','observaciones','promotor'
            ];
            foreach ($camposObligatorios as $campo) {
                if (!isset($data[$campo]) || $data[$campo] === '') {
                    throw new Exception("Falta el campo obligatorio: $campo");
                }
            }
            $stmt = $conexion->prepare("UPDATE solicitud_ayuda SET descripcion = ?, tipo_ayuda = ?, categoria = ?, remitente = ?, observaciones = ?, promotor = ? WHERE id_doc = ?");
            $stmt->execute([$data['descripcion'],$data['tipo_ayuda'], $data['categoria'],$data['remitente'],$data['observaciones'],$data['promotor'],$data['id_doc']]); 
            return ['exito' => true];
            } catch (Exception $e) {
                $db->rollBack();
                error_log("Error al editar la solicitud: " . $e->getMessage());
                return ['exito' => false, 'error' => $e->getMessage()];
            }

        }
}
?>