<?php 
require_once 'modelo/beneficiarioModelo.php';
Class BeneficiarioControl {
    public static function mostrar() {
    if (isset($_GET['ci']) && !empty($_GET['ci'])) {
        $ci = $_GET['ci'];
        $resultado = BeneficiarioModelo::muestra($ci);

        if ($resultado['exito']) {
            $beneficiario = $resultado['datos'];
        } else {
            $error = $resultado['mensaje'] ?? 'No se encontró el beneficiario.';
        }
    } else {
        $error = 'No se proporcionó una cédula válida.';
    }

    require_once 'vistas/informacion_beneficiario.php';
}

}
?>