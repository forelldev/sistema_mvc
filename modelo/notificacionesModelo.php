<?php
require_once 'conexiondb.php';
class notificacionesModelo {
    public static function solicitudesNoVistas() {
    try {
        $conexion = DB::conectar();
        $stmt = $conexion->prepare("SELECT * FROM solicitud_ayuda WHERE visto = 0");
        $stmt->execute();
        $stmt2 = $conexion->prepare("UPDATE solicitud_ayuda SET visto = 1 WHERE visto = 0");
        $stmt2->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error en la base de datos']);
        exit;
    }
}

}
?>