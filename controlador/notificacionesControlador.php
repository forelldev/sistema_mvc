<?php
header('Content-Type: application/json');
require_once '../modelo/notificacionesModelo.php';
$solicitudes = notificacionesModelo::solicitudesNoVistas();
echo json_encode($solicitudes);
?>
