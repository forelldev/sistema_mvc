<?php 
require_once 'conexiondb.php';
class BeneficiarioModelo{
    public static function muestra($ci) {
    $conexion = DB::conectar();

    try {
        $stmt = $conexion->prepare("
            SELECT * FROM solicitantes 
            WHERE ci = :ci
        ");
        $stmt->execute(['ci' => $ci]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return [
                'exito' => true,
                'datos' => $resultado
            ];
        } else {
            return [
                'exito' => false,
                'mensaje' => 'No se encontró ningún solicitante con esa CI.'
            ];
        }
    } catch (Exception $e) {
        error_log("Error al buscar solicitante por CI: " . $e->getMessage());
        return [
            'exito' => false,
            'error' => $e->getMessage()
        ];
    }
}

}
?>